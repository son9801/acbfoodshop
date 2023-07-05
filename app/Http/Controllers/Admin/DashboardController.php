<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {

        $totalProducts = Product::count();
        $totalCategories = Category::count();

        $totalAllUsers = User::count();
        $totalUser = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalAllUsers',
            'totalUser',
            'totalAdmin',
            'todayDate',
            'thisMonth',
            'thisYear',
            'totalOrder',
            'todayOrder',
            'thisMonthOrder',
            'thisYearOrder'
        ));
    }

    public function search(Request $request)
    {
        if ($request->adminSearch) {
            $currentRouteName = Route::currentRouteName();
            
            if ($currentRouteName === 'product.index') {
                $result = Product::where('name', 'LIKE', '%' . $request->adminSearch . '%')->get();
                return view('admin.product.search', compact('result'));
            } else {

                return redirect('admin/product')->with('message', 'Trống');
            }
        }
    }
}
