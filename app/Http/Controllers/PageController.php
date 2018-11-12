<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Shop;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Category;
use App\Models\ProductPromotion;
use App\Models\Comment;
use App\Models\Bill;
use App\Models\BillStatus;
use App\Models\BillProduct;
use App\Repositories\ProductRepository;
use App\Repositories\SlideRepository;
use App\Repositories\ProductColorRepository;
use App\Repositories\ProductSizeRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\BillRepository;
use App\Repositories\BillProductRepository;
use App\Repositories\BillStatusRepository;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;
use Cart;

class PageController extends Controller
{
    private $productRepository;
    private $slideRepository;
    private $proColorRepository;
    private $proSizeRepository;
    private $categoryRepository;
    private $billRepository;
    private $billProductRepository;
    private $billStatusRepository;
    private $commentRepository;

    public function __construct(ProductRepository $productRepository,
        SlideRepository $slideRepository,
        ProductColorRepository $proColorRepository,
        ProductSizeRepository $proSizeRepository,
        CategoryRepository $categoryRepository,
        BillRepository $billRepository,
        BillProductRepository $billProductRepository,
        BillStatusRepository $billStatusRepository,
        CommentRepository $commentRepository)
    {
        $this->productRepository = $productRepository;
        $this->slideRepository = $slideRepository;
        $this->proColorRepository = $proColorRepository;
        $this->proSizeRepository = $proSizeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->billRepository = $billRepository;
        $this->billProductRepository = $billProductRepository;
        $this->billStatusRepository = $billStatusRepository;
        $this->commentRepository = $commentRepository;
    }

    public function getHome()
    {
        $slide = $this->slideRepository->all();
        $product = $this->productRepository->all();
        $product_sale = $this->productRepository->productSale();
        $new_product = $this->productRepository->productNew();
        $product_most_views = $this->productRepository->productMostView();
        $product_best_seller = $this->productRepository->productBestSeller();
        $data = ['slide' => $slide,
        'product' => $product,
        'product_sale' => $product_sale,
        'product_best_seller' => $product_best_seller,
        'new_product' => $new_product,
        'product_most_views' => $product_most_views,
        ];

        return view('pages.home', $data);
    }

    public function getProduct($id)
    {
        $product = $this->productRepository->find($id);
        $product_color = $product->productColors()->get();
        $product_best_seller = $this->productRepository->productBestSeller();
        $product_sale = $this->productRepository->productSale();
        $product_image = $this->productRepository->find($id)->productColors->first()->productImages;
        $product->viewed_count += 1;
        $product->update();
        $comments = $this->commentRepository->findWhere('product_id', $id);
        $sum = 0;
        foreach ($comments as $r) {
            $sum += $r->rate; 
        }
        if (count($comments) != 0)
        {
            $rating = $sum / (count($comments));
        }
        else $rating = 0;
        $j = 0;
        for ($i = 1; $i <= $rating; $i++)
        {
            $j = $i;
        }
        $rating1 = $rating - $j;
        $product_size = $product->productSizes;
        $color_selected = $product_color->first()->id;
        $count_comment = $this->commentRepository->findWhere('product_id', $id)->count();
        $data = ['product_color' => $product_color,
        'comments' => $comments,
        'product' => $product,
        'product_sale' => $product_sale,
        'product_best_seller' => $product_best_seller,
        'rating' => $rating,
        'rating1' => $rating1,
        'count_comment' => $count_comment,
        'product_image' => $product_image,
        'product_size' => $product_size,
        'color_selected' => $color_selected,
        ];

        return view('pages.product_detail', $data);
    }

    public function getProduct_withColor($product_id, $color_id)
    {
        $product = $this->productRepository->find($product_id);
        $product_color = $product->productColors()->get();
        $product_best_seller = $this->productRepository->productBestSeller();
        $product_sale = $this->productRepository->productSale();
        $comments = $this->commentRepository->findWhere('product_id', $product_id);
        $sum = 0;
        foreach ($comments as $r) {
            $sum += $r->rate; 
        }
        if (count($comments) != 0)
        {
            $rating = $sum / (count($comments));
        }
        else $rating = 0;
        $j = 0;
        for($i = 1; $i <= $rating; $i++)
        {
            $j = $i;
        }
        $rating1 = $rating - $j;
        $product_size = $product->productSizes;
        $color_selected = $color_id;
        $product_image = $this->proColorRepository->find($color_id)->productImages;
        $count_comment = $this->commentRepository->findWhere('product_id', $product_id)->count();
        $data = ['product_color' => $product_color,
        'comments' => $comments,
        'product' => $product,
        'product_sale' => $product_sale,
        'product_best_seller' => $product_best_seller,
        'rating' => $rating,
        'rating1' => $rating1,
        'count_comment' => $count_comment,
        'product_image' => $product_image,
        'product_size' => $product_size,
        'color_selected' => $color_selected,
        ];

        return view('pages.product_detail', $data);
    }

    public function comment(Request $request)
    {
        $this->validate($request,
            [
                'comment' => 'required|min:3',
            ],
            [
                'comment.required' => __('message.comment_require'),
                'comment.min' => __('message.comment_min'),
            ]);
        if (Auth::check())
        {   
            $comment = $this->commentRepository->create([
                'rate' => $request->rate,
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'content' => $request->comment,
            ]);
        }
        else
        {
            return redirect()->route('login');
        }

        return redirect()->back();
    }

    public function getProductType($id)
    {   
        $category = $this->categoryRepository->find($id);
        $list_child_category = collect([$category->id => $category]);

        $list_all_category = $this->categoryRepository->all();
        foreach ($list_all_category as $cat)
        {
            $curent_category = $cat;

            while ($curent_category->parent_id != null)
            {
                if ($curent_category->id == $id)
                {
                    array_add($list_child_category, $cat->id, $cat);
                    break;
                }
                $parent_category_id = $curent_category->parent_id;
                $parent_category = $this->categoryRepository->find($parent_category_id);
                $curent_category = $parent_category;
            }
            if ($curent_category->id == $id)
            {
                array_add($list_child_category, $cat->id, $cat);
            }   
        }

        $product_all = array();
        foreach ($list_child_category as $cate)
        {
            $product = $this->productRepository->findWhere('category_id', $cate->id);
            $product_all = (object)array_merge_recursive((array)$product_all, (array)$product);
        }
        $product_all = head($product_all);
        $slide = $this->slideRepository->all();

        return view('pages.category', compact('slide', 'category', 'product_all'));
    }

    public function search(Request $request)
    {
        $slide = $this->slideRepository->all();
        $product = $this->productRepository->searchProduct($request->key);

        return view('pages.search', compact('slide', 'product'));
    }

    public function getCart()
    {
        $cart = Cart::getContent();

        return view('pages.cart', compact('cart'));
    }

    public function addCartDetail($product_id, $color_id, $size_id)
    {
        $product = $this->productRepository->find($product_id);
        $cart = Cart::getContent();
        $cart_id = 1;
        if (count($cart) == 0)
        {
            $cart_id = 1;
        }
        else
        {
            $cart_id = count($cart) + 1;
        }

        $color = $this->proColorRepository->find($color_id);
        $size = $this->proSizeRepository->find($size_id);
        Cart::add([
            'id' => $cart_id,
            'name' => $product->name,
            'quantity' => 1,
            'price' => (($product->unit_price) * (100 - ($product->getPromotions())) / 100),
            'attributes' => [
                'image' => $product->productImages->first()->image,
                'product_id' => $product_id,
                'unit_price' => $product->unit_price,
                'color' => $color->color,
                'size' => $size->size,
                'color_id' => $color_id,
                'size_id' => $size_id,
            ]]);

        return redirect()->route('cart');
    }

    public function minusQtyCart($id)
    {
        $cart = Cart::get($id);
        $cart->quantity -= 1;
        Cart::update($id, ['quantity' => -1]);

        return redirect()->back();
    }

    public function addQtyCart($id)
    {
        $cart = Cart::get($id);
        $cart->quantity += 1;
        Cart::update($id, array('quantity' => 1));

        return redirect()->route('cart');
    }

    public function getCheckout()
    {
        $cart = Cart::getContent();

        return view('pages.checkout', compact('cart'));
    }

    public function postCheckout(Request $request)
    {
        if (Auth::check())
        {
            $cart = Cart::getContent();
            foreach ($cart as $item) {
                $product_id = $item->attributes->product_id;
                $product = $this->productRepository->findWithTrash($product_id);
                if ($product->trashed()) {
                    $deleted_item = $item;
                    
                    return view('pages.checkout', ['cart' => $cart, 'deleted_item' => $deleted_item]);
                }
            }

            foreach ($cart as $item) {
                $product_id = $item->attributes->product_id;
                $product = $this->productRepository->find($product_id);
                $product->purchased_count += $item->quantity;
                $product->update();
            }

            $bill = $this->billRepository->create([
                'user_id' => Auth::user()->id,
                'total_amount' => Cart::getSubTotal(),
                'method_of_payment' => $request->payment,
                'note' => $request->note,
            ]);

            $bill_product = $this->billProductRepository->create([
                'bill_id' => $bill->id,
                'product_id' => $product_id,
                'product_color_id' => $item->attributes->color_id,
                'product_size_id' => $item->attributes->size_id,
                'quantity' => $item->quantity,
            ]);

            $bill_status = $this->billStatusRepository->create([
                'bill_id' => $bill->id,
                'user_id' => Auth::user()->id,
                'status_id' => 1,
            ]);           
        }
        else
        {
            return redirect()->route('login');
        }
        Cart::clear();

        return redirect()->route('order_history');
    }

    public function getOrderHistory()
    {
        $bill = $this->billRepository->findWhere('user_id', Auth::user()->id);

        return view('pages.order_history', compact('bill'));
    }

    public function removeCart($id)
    {
        Cart::remove($id);

        return redirect()->route('cart');
    }

    public function getOrderDetail($id)
    {
        $bill = $this->billRepository->find($id);
        $bill_detail = $this->billProductRepository->findWhere('bill_id', $id);

        return view('pages.order_detail', compact('bill', 'bill_detail'));
    }

    public function getBillUpdate($id)
    {
        $list_item_with_trash = $this->billProductRepository->whereWithTrash('bill_id', $id);
        Cart::clear();
        $cart_id = 1;

        foreach ($list_item_with_trash as $item)
        {
            $color = $this->proColorRepository->find($item->product_color_id)->color;
            $size = $this->proSizeRepository->find($item->product_size_id)->size;
            Cart::add([
                'id' => $cart_id,
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'price' => (($item->product->unit_price) * (100 - ($item->product->getPromotions())) / 100 ),
                'attributes' => [
                    'image' => $item->product->productImages->first()->image,
                    'product_id' => $item->product->id,
                    'unit_price' => $item->product->unit_price,
                    'color' => $color,
                    'size' => $size,
                    'color_id' => $item->product_color_id,
                    'size_id' => $item->product_size_id,
                ]]);

            $cart_id++;
            $item->delete();
        }
        $bill = $this->billRepository->find($id);
        $bill_status = $bill->billStatus;
        foreach ($bill_status as $status)
        {
            $status->delete();
        }
        $bill->delete();

        return redirect()->route('cart');
    }
}
