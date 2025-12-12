<x-layoutUser>

<div class="chat-box">
    <h3>Chat Pesanan: {{ $order->jasa->nama_jasa }}</h3>

    <div class="messages">
        @foreach($order->messages as $msg)
            <div class="msg {{ $msg->sender_id == auth()->id() ? 'me' : 'other' }}">
                <strong>{{ $msg->sender->name }}</strong><br>
                {{ $msg->message }}

                @if($msg->attachment)
                    <br>
                    <img src="{{ asset('storage/'.$msg->attachment) }}" width="140">
                @endif

                <div class="time">{{ $msg->created_at->diffForHumans() }}</div>
            </div>
        @endforeach
    </div>

    <form action="{{ route('order.chat.send', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="message" class="form-control" placeholder="Ketik pesan..."></textarea>

        <input type="file" name="attachment">

        <button class="btn btn-primary mt-2">Kirim</button>
    </form>

</div>

<style>
.chat-box { max-width:800px; margin:auto; }
.messages { padding:10px; background:#f5f5f5; border-radius:8px; margin-bottom:20px; max-height:400px; overflow-y:auto; }
.msg { margin-bottom:15px; padding:10px; border-radius:6px; }
.msg.me { background:#dcfce7; text-align:right; }
.msg.other { background:#e5e7eb; text-align:left; }
</style>

</x-layoutUser>
