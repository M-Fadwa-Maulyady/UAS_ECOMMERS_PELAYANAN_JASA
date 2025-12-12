<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderMessage;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class OrderMessageController extends Controller
{
    public function index($orderId)
    {
        $order = Order::with('messages.sender')->findOrFail($orderId);

        // hanya user pemilik order atau pekerja penyedia jasa
        if (auth()->id() !== $order->user_id && auth()->id() !== $order->worker_id) {
            abort(403);
        }

        return view('chat.order-chat', compact('order'));
    }

    public function send(Request $request, $orderId)
    {
        $request->validate([
            'message' => 'nullable|string',
            'attachment' => 'nullable|file|max:2048'
        ]);

        $order = Order::findOrFail($orderId);

        $data = [
            'order_id' => $orderId,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('chat', 'public');
        }

        OrderMessage::create($data);

        return back();
    }
}
