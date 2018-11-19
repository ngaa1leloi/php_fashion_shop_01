<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostLoginAdminRequest;
use App\Models\User;

class UserController extends Controller
{
    public function getLoginAdmin()
    {
        if (Auth::check() && (Auth::user()->role == config('role.user.admin') || Auth::user()->role == config('role.user.superadmin')))
        {
            return redirect('admin/category/list');
        }
        elseif (Auth::check() && (Auth::user()->role == config('role.user.customer')))
        {
            return redirect('home');
        }

        return view('admin.login');
    }

    public function postLoginAdmin(PostLoginAdminRequest $request)
    {
        $request->validated();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('admin/slide/list');
        }
        else
        {
            $request->session()->flash('failed', __('message.failed'));

            return redirect('admin/login');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function getList()
    {
        $list_user = User::where('role', '<>', config('role.user.superadmin'))->get();

        return view('admin.user.list', ['list_user' => $list_user]);
    }

    public function getEdit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', ['user' => $user]);
    }

    public function postEdit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->checkbox == 'on')
        {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->save();      

        return redirect('admin/user/edit/' . $id)->with('message', __('message.edit'));
    }

    public function getDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $list_user = User::all();

        return view('admin.user.list', ['list_user' => $list_user])->with('message', __('delete'));
    }

    public function getLogout()
    {
        Auth::logout();

        return view('admin.login');
    }
}
