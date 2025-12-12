<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ChatMessage;   // <= TAMBAHKAN INI
use App\Models\OrderMessage;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // ADMIN LIST
    public function index() {
        $orders = Order::with(['user','jasa','worker'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // ADMIN APPROVE
    public function approve($id) {
        Order::findOrFail($id)->update([
            'status' => Order::STATUS_WAITING_WORKER
        ]);
        return back()->with('success', 'Pesanan dikirim ke pekerja.');
    }

    public function reject($id) {
        Order::findOrFail($id)->update(['status' => Order::STATUS_REJECTED_ADMIN]);
        return back()->with('success','Pesanan ditolak.');
    }

    // WORKER PANEL
    public function workerOrders() {
        return view('pekerja.orders.index', [
            'pendingOrders' => Order::where('worker_id',auth()->id())->where('status',Order::STATUS_WAITING_WORKER)->get(),
            'activeOrders'  => Order::where('worker_id',auth()->id())->where('status',Order::STATUS_WAITING_PAYMENT)->get(),
            'historyOrders' => Order::where('worker_id',auth()->id())->whereIn('status',[Order::STATUS_REVISION,Order::STATUS_FINISHED])->get(),
        ]);
    }

    public function workerAccept($id) {
        Order::findOrFail($id)->update([
            'status' => Order::STATUS_WAITING_PAYMENT
        ]);
        return back()->with('success','Pesanan diterima, menunggu pembayaran user.');
    }

    public function workerReject($id) {
        Order::findOrFail($id)->update(['status' => Order::STATUS_REVISION]);
        return back()->with('success','Pesanan ditolak.');
    }

    public function workerFinish(Request $request, $id)
    {
        $request->validate([
            'bukti_pengerjaan' => 'required|image|max:2048',
        ]);

        $order = Order::findOrFail($id);

        $fileName = time() . '_' . $request->file('bukti_pengerjaan')->getClientOriginalName();
        $request->file('bukti_pengerjaan')->storeAs('uploads/bukti', $fileName, 'public');

        $order->update([
            'bukti_pengerjaan' => $fileName,
            'status' => Order::STATUS_WAITING_USER_CONFIRM,
        ]);

        return back()->with('success', 'Bukti dikirim, menunggu konfirmasi pelanggan.');
    }

    // USER PANEL
    public function userOrders() {
        return view('user.orders.index',[
            'orders'=>Order::where('user_id',auth()->id())->get()
        ]);
    }

    // USER CONFIRM
    public function userConfirm($id){
        Order::findOrFail($id)->update(['status'=>Order::STATUS_FINISHED]);
        return back()->with('success','Pesanan selesai ✔');
    }

    public function userReject($id){
        Order::findOrFail($id)->update(['status'=>Order::STATUS_REVISION]);
        return back()->with('warning','Revisi diminta.');
    }

    public function chat($id)
    {
    $order = Order::with(['jasa', 'worker', 'user'])->findOrFail($id);

    // Pastikan hanya user terkait yg bisa buka chat
    if (auth()->id() != $order->user_id && auth()->id() != $order->worker_id) {
        abort(403, 'Unauthorized');
    }

    $messages = ChatMessage::where('order_id', $id)->orderBy('created_at')->get();

    return view('user.orders.chat', compact('order', 'messages'));
    }

    public function sendChat(Request $request, $id)
    {
    $request->validate([
        'message' => 'required|string',
    ]);

    ChatMessage::create([
        'order_id' => $id,
        'sender_id' => auth()->id(),
        'message' => $request->message,
    ]);

    return back();
    }       

}
