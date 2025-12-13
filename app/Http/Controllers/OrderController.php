<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ===============================
    // ADMIN
    // ===============================
    public function index()
    {
        $orders = Order::with(['user','jasa','worker'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function approve($id)
    {
        Order::findOrFail($id)->update([
            'status' => Order::STATUS_WAITING_WORKER
        ]);
        return back()->with('success', 'Pesanan dikirim ke pekerja.');
    }

    public function reject($id)
    {
        Order::findOrFail($id)->update([
            'status' => Order::STATUS_REJECTED_ADMIN
        ]);
        return back()->with('success','Pesanan ditolak.');
    }

    // ===============================
    // WORKER
    // ===============================
    public function workerOrders()
    {
        return view('pekerja.orders.index', [
            'pendingOrders' => Order::where('worker_id',auth()->id())
                ->where('status',Order::STATUS_WAITING_WORKER)->get(),

            'activeOrders' => Order::where('worker_id',auth()->id())
                ->where('status',Order::STATUS_WAITING_PAYMENT)->get(),

            'historyOrders' => Order::where('worker_id',auth()->id())
                ->whereIn('status',[
                    Order::STATUS_REVISION,
                    Order::STATUS_FINISHED
                ])->get(),
        ]);
    }

    public function workerChatList()
    {
        $orders = Order::where('worker_id', auth()->id())
            ->with('user')
            ->latest()
            ->get();

        return view('pekerja.chat.index', compact('orders'));
    }

    public function workerChat($id)
    {
        $order = Order::with(['user', 'jasa'])->findOrFail($id);

        if ($order->worker_id !== auth()->id()) {
            abort(403);
        }

        $messages = ChatMessage::where('order_id', $id)
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        return view('pekerja.chat.order-chat', compact('order', 'messages'));
    }


    // ===============================
    // USER
    // ===============================
    public function userOrders()
    {
        return view('user.orders.index', [
            'orders' => Order::where('user_id',auth()->id())->get()
        ]);
    }

    public function chat($id)
    {
        $order = Order::with(['jasa','worker','user'])->findOrFail($id);

        if (auth()->id() != $order->user_id && auth()->id() != $order->worker_id) {
            abort(403);
        }

        $messages = ChatMessage::where('order_id', $id)
            ->with('sender')
            ->orderBy('created_at')
            ->get();

        if (auth()->user()->role === 'pekerja') {
            return view('pekerja.chat.show', compact('order','messages'));
        }

        return view('user.orders.chat', compact('order','messages'));
    }

    // ===============================
    // SEND CHAT (USER & WORKER)
    // ===============================
    public function sendChat(Request $request, $id)
    {
        $request->validate([
            'message' => 'nullable|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        if (!$request->message && !$request->hasFile('image')) {
            return back()->with('error','Pesan atau gambar harus diisi.');
        }

        $data = [
            'order_id'  => $id,
            'sender_id' => auth()->id(),
            'message'   => $request->message,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('chat','public');
        }

        ChatMessage::create($data);

        return back();
    }
}
