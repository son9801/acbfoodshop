<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Livewire\WithPagination;

class OrderController extends Controller
{
    use WithPagination;
    public function index(Request $request)
    {
        // $todayDate = Carbon::now()->format(('Y-m-d'));
        // $orders = Order::when($request->filled(['date1', 'date2']), function ($q) use ($request) {
        //     $date1 = $request->input('date1');
        //     $date2 = $request->input('date2');
        //     return $q->whereBetween('created_at', [$date1, $date2]);
        // }, function ($q) use ($todayDate) {
        //     return $q->whereDate('created_at', $todayDate);
        // })
        //     ->when($request->status != null, function ($q) use ($request) {
        //         return $q->where('status_message', $request->status);
        //     })
        //     ->when($request->has('order_id'), function ($q) use ($request) {
        //         return $q->where('id', $request->input('order_id'));
        //     })
        //     ->paginate(3);

        // $orders->appends(request()->input());
        $orders = Order::query();
        if ($request->filled('order_id')) {
            $orders->where('id', $request->input('order_id'));
        } else {
            if ($request->filled(['date1', 'date2'])) {
                $date1 = $request->input('date1');
                $date2 = $request->input('date2');
                $orders->whereBetween('created_at', [$date1, $date2]);
            } else {
                $todayDate = Carbon::now()->format(('Y-m-d'));
                $orders->whereDate('created_at', $todayDate);
            }

            if ($request->status != null) {
                $orders->where('status_message', $request->status);
            }
        }


        $orders = $orders->paginate(3)->appends(request()->input());
        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect('admin/orders')->with('message', 'Ko tìm thấy mã đơn hàng');
        }
    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect('admin/orders/' . $orderId)->with('message', 'Đã cập nhật trạng thái');
        } else {
            return redirect('admin/orders' . $orderId)->with('message', 'Ko tìm thấy mã đơn hàng');
        }
    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }


    public function generateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
        Pdf::setOption(['dpi' => 150, 'defaultFont' => 'Dejavu Sans']);

        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-' . $order->id . '-' . $todayDate . '.pdf');
    }
}
