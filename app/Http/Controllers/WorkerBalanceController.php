<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class WorkerBalanceController extends Controller
{
    // Halaman saldo pekerja
    public function index()
    {
        $user = auth()->user();
        $withdraws = Withdraw::where('user_id', $user->id)->latest()->get();

        return view('pekerja.saldo.index', compact('user', 'withdraws'));
    }

    // Ajukan withdraw
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'bank_name' => 'required',
            'rekening' => 'required',
        ]);

        $user = auth()->user();

        if ($request->amount > $user->saldo) {
            return back()->with('error', 'Saldo tidak cukup.');
        }

        // kurangi saldo
        $user->saldo -= $request->amount;
        $user->save();

        // buat record withdraw
        Withdraw::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'bank_name' => $request->bank_name,
            'rekening' => $request->rekening,
        ]);

        return back()->with('success', 'Permintaan penarikan dikirim. Menunggu persetujuan admin.');
    }
}

