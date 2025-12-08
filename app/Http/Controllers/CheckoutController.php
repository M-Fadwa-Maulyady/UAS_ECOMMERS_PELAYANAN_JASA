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
        $request->validate([
            'alamat' => 'required',
            'tanggal' => 'required|date'
        ]);

        $jasa = Jasa::findOrFail($id);

        Order::create([
            'user_id'   => auth()->id(),
            'jasa_id'   => $jasa->id,
            'worker_id' => $jasa->user_id,
            'alamat'    => $request->alamat,
            'tanggal'   => $request->tanggal,
            'status'    => 'pending_admin'
        ]);

        return redirect()->route('checkout.success')
    ->with('success', 'Pesanan berhasil! Menunggu verifikasi admin.');
    }
}

