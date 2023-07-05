<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
       $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);

        return redirect('/admin/users')->with('message', 'Tạo thành công người dùng mới');
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        $user_details = UserDetail::where('user_id',$userId)->first();
        return view('admin.users.edit', compact('user','user_details'));
    }

    public function update(Request $request, int $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_as' => ['required', 'integer'],
            // 'password' => ['string', 'min:8'],
        ]);
 
        User::findOrFail($userId)->update([
            'name' => $request->name,
            'role_as' => $request->role_as,
            // 'password' => Hash::check($request->password,$userId->password),
        ]);

        return redirect('/admin/users')->with('message', 'Sửa thành công thông tin người dùng');
    }
}
