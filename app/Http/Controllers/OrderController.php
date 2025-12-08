<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ======= ADMIN SIDE LIST ORDER =======
    public function index()
    {
        $orders = Order::with(['user', 'jasa', 'worker'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // ======= ADMIN APPROVE ORDER =======
    public function approve($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => Order::STATUS_WAITING_WORKER
        ]);

        return back()->with('success', 'Pesanan disetujui dan telah dikirim ke pekerja.');
    }

    // ======= ADMIN REJECT ORDER =======
    public function reject($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => Order::STATUS_REJECTED_ADMIN
        ]);

        return back()->with('success', 'Pesanan telah ditolak.');
    }

    // ======= WORKER ORDER VIEW =======
    public function workerOrders()
    {
        $pendingOrders = Order::where('worker_id', auth()->id())
            ->where('status', Order::STATUS_WAITING_WORKER)
            ->get();

        $activeOrders = Order::where('worker_id', auth()->id())
            ->where('status', Order::STATUS_WORKER_ACCEPTED)
            ->get();

        $historyOrders = Order::where('worker_id', auth()->id())
            ->whereIn('status', [
                Order::STATUS_WORKER_REJECTED,
                Order::STATUS_FINISHED
            ])
            ->get();

        return view('pekerja.orders.index', compact('pendingOrders', 'activeOrders', 'historyOrders'));
    }

    // ======= WORKER ACTION =======
    public function workerAccept($id)
    {
        Order::findOrFail($id)->update([
            'status' => Order::STATUS_WORKER_ACCEPTED
        ]);

        return back()->with('success', 'Pesanan mulai dikerjakan!');
    }

    public function workerReject($id)
    {
        Order::findOrFail($id)->update([
            'status' => Order::STATUS_WORKER_REJECTED
        ]);

        return back()->with('success', 'Pesanan ditolak.');
    }

    public function workerFinish($id)
    {
        Order::findOrFail($id)->update([
            'status' => Order::STATUS_FINISHED
        ]);

        return back()->with('success', 'Pesanan berhasil diselesaikan!');
    }
}
