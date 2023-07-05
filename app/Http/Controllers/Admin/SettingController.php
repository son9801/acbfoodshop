<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting.index',compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = Setting::first();
        if ($setting) {
            $setting->update([
                'website_name' => $request->website_name,
                'website_url'=> $request->website_url,
                'address'=> $request->address,
                'phone'=> $request->phone,
                'email'=> $request->email,
                'facebook'=> $request->facebook,
                'youtube'=> $request->youtube
            ]);

            return redirect()->back()->with('message','Sửa thành công thông tin website');
        } else {
            //Create data

            Setting::create([
                'website_name' => $request->website_name,
                'website_url'=> $request->website_url,
                'address'=> $request->address,
                'phone'=> $request->phone,
                'email'=> $request->email,
                'facebook'=> $request->facebook,
                'youtube'=> $request->youtube
            ]);

            return redirect()->back()->with('message','Tạo mới thành công thông tin website');
        }
    }
}
