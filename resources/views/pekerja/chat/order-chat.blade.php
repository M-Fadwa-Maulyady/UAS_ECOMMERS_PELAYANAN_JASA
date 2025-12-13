<x-layoutJasa title="Chat Pelanggan">

<style>
.chat-container {
    max-width: 900px;
    margin: 25px auto;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 24px rgba(0,0,0,.08);
    display: flex;
    flex-direction: column;
    height: 75vh;
    overflow: hidden;
}

/* HEADER */
.chat-header {
    background: #0E6B50;
    color: white;
    padding: 14px 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* BODY */
.chat-box {
    flex: 1;
    padding: 18px;
    overflow-y: auto;
    background: #f4f7f6;
    display: flex;
    flex-direction: column;
}

/* BUBBLE */
.message {
    max-width: 65%;
    padding: 12px 16px;
    margin-bottom: 12px;
    border-radius: 16px;
    font-size: 14.5px;
    line-height: 1.45;
    word-wrap: break-word;
}

/* PEKERJA (KANAN) */
.me {
    align-self: flex-end;
    background: #0E6B50;
    color: white;
    border-bottom-right-radius: 6px;
}

/* USER (KIRI) */
.other {
    align-self: flex-start;
    background: #e6ecea;
    color: #222;
    border-bottom-left-radius: 6px;
}

.message img {
    max-width: 240px;
    border-radius: 12px;
    margin-top: 6px;
    display: block;
}

.message small {
    display: block;
    font-size: 11px;
    opacity: .65;
    margin-top: 6px;
    text-align: right;
}

/* INPUT */
.chat-input {
    padding: 14px;
    border-top: 1px solid #ddd;
    display: flex;
    align-items: center;
    gap: 10px;
    background: #fff;
}

.chat-input textarea {
    resize: none;
    height: 46px;
    border-radius: 14px;
    padding: 10px 14px;
    width: 100%;
    border: 1px solid #ccc;
}

.chat-input input[type=file] {
    display: none;
}

.file-btn {
    font-size: 18px;
    cursor: pointer;
}

.chat-input button {
    padding: 0 22px;
    height: 46px;
    border-radius: 14px;
    font-weight: 600;
}
</style>

<div class="chat-container">

    {{-- HEADER --}}
    <div class="chat-header">
        💬 Chat dengan {{ $order->user->name }}
    </div>

    {{-- CHAT --}}
    <div class="chat-box" id="chatBox">
        @foreach($messages as $msg)
            <div class="message {{ $msg->sender_id == auth()->id() ? 'me' : 'other' }}">

                @if($msg->message)
                    {{ $msg->message }}
                @endif

                @if($msg->image)
                    <img src="{{ asset('storage/'.$msg->image) }}">
                @endif

                <small>{{ $msg->created_at->format('H:i') }}</small>
            </div>
        @endforeach
    </div>

    {{-- INPUT --}}
    <form method="POST"
          action="{{ route('pekerja.chat.send', $order->id) }}"
          enctype="multipart/form-data"
          class="chat-input">
        @csrf

        <label class="file-btn">
            📎
            <input type="file" name="image" accept="image/*">
        </label>

        <textarea name="message" placeholder="Balas pesan..."></textarea>

        <button class="btn btn-success">Kirim</button>
    </form>

</div>

<script>
const chatBox = document.getElementById('chatBox');
chatBox.scrollTop = chatBox.scrollHeight;
</script>

</x-layoutJasa>
