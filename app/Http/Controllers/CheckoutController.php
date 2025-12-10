<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Jasa;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkoutPage($slug)
    {
        $jasa = Jasa::where('slug', $slug)->firstOrFail();
        return view('user.checkout', compact('jasa'));
    }

    public function store(Request $request, $id)
{
    $jasa = Jasa::findOrFail($id);

    $adminFee = $jasa->harga * 0.10;
    $total = $jasa->harga + $adminFee;

    Order::create([
        'user_id' => auth()->id(),
        'jasa_id' => $jasa->id,
        'worker_id' => $jasa->user_id,
        'alamat' => $request->alamat,
        'tanggal' => $request->tanggal,
        'status' => Order::STATUS_PENDING_ADMIN,
        'admin_fee' => $adminFee,
        'total_transfer' => $total,
    ]);

    return redirect()->route('checkout.success')
        ->with('success', 'Pesanan berhasil! Tunggu persetujuan admin.');
}

}

