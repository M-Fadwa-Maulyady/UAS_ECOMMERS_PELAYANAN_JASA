<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // 1️⃣ User membuka halaman pembayaran
    public function create($orderId){
        $order = Order::with('jasa')->findOrFail($orderId);

        return view('user.payment.index', compact('order'));
    }

    // 2️⃣ User pilih metode pembayaran → buat record payment
    public function store(Request $request, $orderId){
        $request->validate([
            'payment_method' => 'required'
        ]);

        $order = Order::findOrFail($orderId);

        $total = $order->jasa->harga;
        $fee = $total * 0.10;
        $workerAmount = $total - $fee;

        $payment = Payment::create([
    'order_id' => $order->id,
    'user_id'  => auth()->id(),
    'method'   => $request->payment_method, // langsung enum yg sesuai
    'bank_name' => $request->payment_method, 
    'total'    => $total,
    'fee_admin' => $fee,
    'worker_receive' => $workerAmount,
    'status' => 'waiting_upload'
]);



        // update order status
        $order->update(['status' => 'waiting_upload']);

        return redirect()->route('payment.upload.form', $payment->id)
            ->with('success', 'Silakan upload bukti pembayaran.');
    }

    // 3️⃣ Halaman upload bukti pembayaran
    public function uploadForm(Payment $payment){
        return view('user.payment.upload', compact('payment'));
    }

    // 4️⃣ Submit bukti pembayaran
    public function upload(Request $request, Payment $payment){

        $request->validate(['bukti' => 'required|image|max:2048']);

        $file = time().'_'.$request->file('bukti')->getClientOriginalName();
        $request->file('bukti')->storeAs('payment_proof', $file, 'public');

        $payment->update([
            'bukti_transfer' => $file,
            'status' => 'waiting_verification'
        ]);

        // Order ikut berubah status
        $payment->order->update(['status' => 'waiting_verification']);

        return redirect()->route('user.orders')
            ->with('success', 'Bukti berhasil dikirim, admin akan verifikasi.');
    }

    // 5️⃣ ADMIN ACTION
    public function approve(Payment $payment){
        $payment->update(['status' => 'paid']);
        $payment->order->update(['status' => 'waiting_worker']);

        return back()->with('success','Pembayaran dikonfirmasi!');
    }

    public function sendToWorker(Payment $payment)
{
    // Ubah status pembayaran
    $payment->update(['status' => 'done']);

    // Ubah status order
    $payment->order->update(['status' => 'finished']);

    // Ambil pekerja dari order
    $worker = $payment->order->worker; // pastikan relasi ada

    if ($worker) {
        // Tambahkan saldo pekerja
        $worker->saldo += $payment->worker_receive;
        $worker->save();
    }

    return back()->with('success', 'Dana berhasil dikirim ke pekerja!');
}



    // =====================
//  ADMIN LIST PAYMENT
// =====================
public function index()
{
    $payments = Payment::with(['order', 'order.user'])->latest()->get();

    return view('admin.payments.index', compact('payments'));
}

}
