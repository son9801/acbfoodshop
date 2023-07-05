<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Charts\Revenue;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class RevenueController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu từ doanh thu
        $revenue = Orderitem::when($request->filled(['date1', 'date2']), function ($q) use ($request) {
            $date1 = $request->input('date1');
            $date2 = $request->input('date2');
            return $q->whereBetween('created_at', [$date1, $date2])->groupBy('date');
        }, function ($q)  {
            return $q->whereDate('created_at', Carbon::now()->toDateString())->groupBy('date');
        })->select(DB::raw('DATE(created_at) as date, SUM(price) as revenue'))->get();

        //Tạo biểu đồ doanh thu
        $chart = new Revenue;
        $chart->labels($revenue->pluck('date'));
        $chart->title('Doanh thu theo ngày');
        $chart->dataset('Doanh thu', 'bar', $revenue->pluck('revenue'))->options(([
            'backgroundColor' => ' #4d94ff',
        ]));


        //Thống kê sản phẩm chiếm tổng sổ

        // Lấy dữ liệu sản phẩm đã bán theo khoảng thời gian được lọc
        $soldProducts = Orderitem::when($request->filled(['date1', 'date2']), function ($q) use ($request) {
            $date1 = $request->input('date1');
            $date2 = $request->input('date2');
            return $q->whereBetween('created_at', [$date1, $date2]);
        }, function ($q) {
            return $q->whereDate('created_at', Carbon::now()->toDateString());
        })->get();

        // Tính số lượng sản phẩm bán ra của từng category
        $categoryCounts = [];
        foreach ($soldProducts as $product) {
            $categoryId = $product->product->category_id;
            $categoryName = $product->product->category->name;
            if (!isset($categoryCounts[$categoryId])) {
                $categoryCounts[$categoryId] = [
                    'category_name' => $categoryName,
                    'count' => 0,
                ];
            }
            $categoryCounts[$categoryId]['count'] += $product->quantity;
        }

        // Tạo mảng dữ liệu cho biểu đồ tròn
        $chartData = collect($categoryCounts)->map(function ($category) {
            return [
                'category_name' => $category['category_name'],
                'count' => $category['count'],
            ];
        })->toArray();

        // Tạo biểu đồ tròn
        $chart1 = new Revenue;
        $chart1->labels(array_column($chartData, 'category_name'));
        $chart1->title('Tỷ lệ danh mục sản phẩm chiếm trên tổng số doanh thu');
        $chart1->dataset('Sản phẩm', 'pie', array_column($chartData, 'count'))->options([
            'backgroundColor' => ['#4d94ff', '#ff3333', '#ffff66', '#66ff66', '#cc66ff', '#ff99ff', '#66ffff', '#ffcc00', '#99ccff', '#ccff66'],
            'hoverBackgroundColor' => ['#3385ff', '#ff1a1a', '#ffff00', '#00cc00', '#9900cc'],
        ]);

        //San pham ban chay
        $products = Orderitem::when($request->filled(['date1', 'date2']), function ($q) use ($request) {
            $date1 = $request->input('date1');
            $date2 = $request->input('date2');
            return $q->whereBetween('order_items.created_at', [$date1, $date2]);
        }, function ($q)  {
            return $q->whereDate('order_items.created_at', Carbon::now()->toDateString());
        })
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('order_items.product_id', 'products.name', DB::raw('SUM(order_items.quantity) as total_sales'))
            ->groupBy('order_items.product_id', 'products.name')
            ->orderBy('total_sales', 'desc')
            ->take(10)
            ->get();

        return view('admin.revenue.index', compact('chart', 'chart1', 'products'));
    }

    public function indexMonth(Request $request)
    {
        
        $revenue = Orderitem::when($request->filled(['month1', 'month2']), function ($q) use ($request) {
            $month1 = $request->input('month1');
            $month2 = $request->input('month2');
            $startOfMonth1 = Carbon::createFromFormat('Y-m', $month1)->startOfMonth();
            $endOfMonth2 = Carbon::createFromFormat('Y-m', $month2)->endOfMonth();
            return $q->whereBetween('created_at', [$startOfMonth1, $endOfMonth2])->groupBy('month');
        }, function ($q) {
            return $q->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)->groupBy('month');
         
        })->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(price) as revenue'))->get();

        $chart = new Revenue;
        $chart->labels($revenue->pluck('month'));
        $chart->title('Doanh thu theo tháng');
        $chart->dataset('Doanh thu', 'bar', $revenue->pluck('revenue'))->options(([
            'backgroundColor' => ' #4d9'
        ]));


        // Lấy danh sách sản phẩm đã bán trong khoảng thời gian được chọn
        $soldProducts = Orderitem::when($request->filled(['month1', 'month2']), function ($q) use ($request) {
            $month1 = $request->input('month1');
            $month2 = $request->input('month2');
            $startOfMonth1 = Carbon::createFromFormat('Y-m', $month1)->startOfMonth();
            $endOfMonth2 = Carbon::createFromFormat('Y-m', $month2)->endOfMonth();
            return $q->whereBetween('created_at', [$startOfMonth1, $endOfMonth2]);
        }, function ($q)  {
            return $q->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', '=', Carbon::now()->month);
        })->get();

        $categoryCounts = [];
        foreach ($soldProducts as $product) {
            $categoryId = $product->product->category_id;
            $categoryName = $product->product->category->name;
            if (!isset($categoryCounts[$categoryId])) {
                $categoryCounts[$categoryId] = [
                    'category_name' => $categoryName,
                    'count' => 0,
                ];
            }
            $categoryCounts[$categoryId]['count'] += $product->quantity;
        }

        $chartData = collect($categoryCounts)->map(function ($category) {
            return [
                'category_name' => $category['category_name'],
                'count' => $category['count'],
            ];
        })->toArray();

        // Tạo biểu đồ tròn
        $chart1 = new Revenue;
        $chart1->labels(array_column($chartData, 'category_name'));
        $chart1->title('Tỷ lệ danh mục sản phẩm chiếm trên tổng số doanh thu');
        $chart1->dataset('Sản phẩm', 'pie', array_column($chartData, 'count'))->options([
            'backgroundColor' => ['#4d94ff', '#ff3333', '#ffff66', '#66ff66', '#cc66ff', '#ff99ff', '#66ffff', '#ffcc00', '#99ccff', '#ccff66'],
            'hoverBackgroundColor' => ['#3385ff', '#ff1a1a', '#ffff00', '#00cc00', '#9900cc'],
        ]);


        $products = Orderitem::when($request->filled(['month1', 'month2']), function ($q) use ($request) {
            $month1 = $request->input('month1');
            $month2 = $request->input('month2');
            $startOfMonth1 = Carbon::createFromFormat('Y-m', $month1)->startOfMonth();
            $endOfMonth2 = Carbon::createFromFormat('Y-m', $month2)->endOfMonth();
            return $q->whereBetween('order_items.created_at', [$startOfMonth1, $endOfMonth2]);
        }, function ($q) {
            return $q->whereYear('order_items.created_at', Carbon::now()->year)
                ->whereMonth('order_items.created_at', Carbon::now()->month);
        })->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('order_items.product_id', 'products.name', DB::raw('SUM(order_items.quantity) as total_sales'))
            ->groupBy('order_items.product_id', 'products.name')
            ->orderBy('total_sales', 'desc')
            ->take(10)
            ->get();

        return view('admin.revenue.indexMonth', compact('chart', 'chart1', 'products'));
    }


    //thống kế theo năm
    public function indexYear(Request $request)
    {
        //lấy doanh thu theo năm
        $revenue = Orderitem::when($request->filled(['year1', 'year2']), function ($q) use ($request) {
            $year1 = $request->input('year1');
            $year2 = $request->input('year2');
            return $q->whereBetween(DB::raw('YEAR(created_at)'), [$year1, $year2])->groupBy('year');
        }, function ($q) {
            return $q->whereYear('created_at', Carbon::now()->year)->groupBy('year');
        })->select(DB::raw('YEAR(created_at) as year, SUM(price) as revenue'))->get();

        //tạo biểu đồ doanh thu
        $chart = new Revenue;
        $chart->labels($revenue->pluck('year'));
        $chart->title('Doanh thu theo năm');
        $chart->dataset('Doanh thu', 'bar', $revenue->pluck('revenue'))->options(([
            'backgroundColor' => ' #4d94ff'
        ]));



        //lấy danh mục / doanh thu
        $soldProducts = Orderitem::when($request->filled(['year1', 'year2']), function ($q) use ($request) {
            $year1 = $request->input('year1');
            $year2 = $request->input('year2');
            return $q->whereBetween(DB::raw('YEAR(created_at)'), [$year1, $year2]);
        }, function ($q) {
            return $q->whereYear('created_at', Carbon::now()->year);
        })->get();

        $categoryCounts = [];
        foreach ($soldProducts as $product) {
            $categoryId = $product->product->category_id;
            $categoryName = $product->product->category->name;
            if (!isset($categoryCounts[$categoryId])) {
                $categoryCounts[$categoryId] = [
                    'category_name' => $categoryName,
                    'count' => 0,
                ];
            }
            $categoryCounts[$categoryId]['count'] += $product->quantity;
        }

        $chartData = collect($categoryCounts)->map(function ($category) {
            return [
                'category_name' => $category['category_name'],
                'count' => $category['count'],
            ];
        })->toArray();

        //tạo biểu đồ
        $chart1 = new Revenue;
        $chart1->labels(array_column($chartData, 'category_name'));
        $chart1->title('Tỷ lệ danh mục sản phẩm chiếm trên tổng số doanh thu');
        $chart1->dataset('Sản phẩm', 'pie', array_column($chartData, 'count'))->options([
            'backgroundColor' => ['#4d94ff', '#ff3333', '#ffff66', '#66ff66', '#cc66ff', '#ff99ff', '#66ffff', '#ffcc00', '#99ccff', '#ccff66'],
            'hoverBackgroundColor' => ['#3385ff', '#ff1a1a', '#ffff00', '#00cc00', '#9900cc'],
        ]);
        //

        //san pham ban chay
        $products = Orderitem::when($request->filled(['year1', 'year2']), function ($q) use ($request) {
            $year1 = $request->input('year1');
            $year2 = $request->input('year2');
            return $q->whereBetween(DB::raw('YEAR(order_items.created_at)'), [$year1, $year2]);
        }, function ($q) {
            return $q->whereYear('order_items.created_at', Carbon::now()->year);
        })->join('products', 'order_items.product_id','products.id')
            ->select('order_items.product_id', 'products.name', DB::raw('SUM(order_items.quantity) as total_sales'))
            ->groupBy('order_items.product_id', 'products.name')
            ->orderBy('total_sales', 'desc')
            ->take(10)
            ->get();

        return view('admin.revenue.indexYear', compact('chart', 'chart1', 'products'));
    }
}
