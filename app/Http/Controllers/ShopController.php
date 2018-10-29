<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Branch;
use App\Http\Requests\AddShopRequest;
use App\Http\Requests\EditShopRequest;

class ShopController extends Controller
{
    public function getList()
    {
        $shop = Shop::all();

        return view('admin.shop.list', compact('shop'));
    }

    public function getAdd()
    {
        $branch = Branch::all();

        return view('admin.shop.add', compact('branch'));
    }

    public function postAdd(AddShopRequest $request)
    {
        $shop = Shop::create([
            'name' => $request['name'],
            'branch_id' => $request['province'],
            'address' => $request['address'],
            'phone' => $request['phone'],
        ]);

        return redirect('admin/shop/add')->with('message', __('message.add'));
    }

    public function getEdit($id)
    {
        $branch = Branch::all();
        $shop = Shop::findOrFail($id);

        return view('admin.shop.edit', compact('shop', 'branch'));
    }

    public function postEdit(EditShopRequest $request, $id)
    {
        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->branch_id = $request->province;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->update();

        return redirect('admin/shop/edit/' . $id)->with('message', __('message.edit'));
    }

    public function getDelete($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect('admin/shop/list')->with('message', __('message.delete'));
    }
}
