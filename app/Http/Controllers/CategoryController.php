<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Requests\PostAddCategoryRequest;
use App\Http\Requests\PostEditCategoryRequest;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getList()
    {
        $category = $this->categoryRepository->all();

        return view('admin/category/list', ['category' => $category]);
    }

    public function getAdd()
    {
        $list_top_category = $this->categoryRepository->whereNull('parent_id');
        
        return view('admin.category.add', ['list_top_category' => $list_top_category]);
    }

    public function postAdd(PostAddCategoryRequest $request)
    {
        $category = $this->categoryRepository->create([
            'name' => $request->name,
            'parent_id' => $request->parent_category,
            'slug' => str_slug($request->name),
            'priority' => $request->priority,
        ]);

        return redirect('admin/category/add')->with('success', __('message.add'));
    }

    public function getEdit($id)
    {
        $category = $this->categoryRepository->find($id);
        $list_top_category = $this->categoryRepository->whereNull('parent_id');
        $curent_category = $category;
        while ($curent_category->parent_id != null) {
            $parent_category_id = $curent_category->parent_id;
            $parent_category = $this->categoryRepository->find($parent_category_id);
            $curent_category = $parent_category;
        }
        $top_category_id = $curent_category->id;

        return view('admin/category/edit', ['category' => $category, 'list_top_category' => $list_top_category, 'top_category_id' => $top_category_id]);
    }

    public function postEdit(PostEditCategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        $category = $this->productRepository->update($id, [
            'name' => $request->name,
            'parent_id' => $request->parent_category,
            'slug' => str_slug($request->name),
            'priority' => $request->priority,
        ]);

        return redirect()->route('edit_category', ['id' => $id])->with('success', __('message.edit'));
    }

    public function getDelete($id)
    {
        $selected_category = $this->productRepository->find($id);
        $category_list = $this->productRepository->whereNotNull('parent_id');
        $array = collect([$id => $selected_category]);
        foreach ($category_list as $cat) {
            $curent_category = $cat;
            while ($curent_category->parent_id == null) {
                if ($curent_category->parent_id == $id) {
                    array_add($array, $cat->id, $cat);
                    break;
                } else {
                    $parent_category_id = $curent_category->parent_id;
                    $parent_category = $this->productRepository->find($parent_category_id);
                    $curent_category = $parent_category;
                }
            }
        }
        foreach ($array as $deleted_category) {
            $deleted_category->delete();
        }

        return redirect()->route('list_category')->with('success', __('message.delete'));
    }
}
