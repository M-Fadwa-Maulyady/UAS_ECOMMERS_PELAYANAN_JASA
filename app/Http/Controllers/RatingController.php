<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create(Order $order)
    {
        if (
            $order->user_id !== auth()->id() ||
            $order->status !== 'finished' ||
            $order->rating
        ) {
            abort(403);
        }

        return view('user.rating.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        if ($order->rating) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500'
        ]);

        Rating::create([
            'order_id'  => $order->id,
            'worker_id' => $order->worker_id,
            'user_id'   => auth()->id(),
            'rating'    => $request->rating,
            'review'    => $request->review,
        ]);

        return redirect()->route('user.orders')
            ->with('success', 'Terima kasih atas ratingnya ⭐');
    }

    public function workerIndex()
    {
        $ratings = Rating::with(['user', 'order.jasa'])
            ->where('worker_id', auth()->id())
            ->latest()
            ->get();

        return view('pekerja.rating.index', compact('ratings'));
    }

}


