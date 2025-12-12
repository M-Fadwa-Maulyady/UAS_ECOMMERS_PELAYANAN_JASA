<x-layoutUser title="Chat">

<style>
/* WRAPPER UTAMA */
.chat-container {
    max-width: 760px;
    margin: 35px auto;
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
    height: 78vh;
    overflow: hidden;
}

/* HEADER */
.chat-header {
    background: #0E6B50;
    color: white;
    text-align: center;
    padding: 14px 20px;
    font-size: 17px;
    font-weight: 600;
    letter-spacing: 0.2px;
}

/* AREA PESAN */
.chat-box {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: #f5f7f6;
    scroll-behavior: smooth;
    display: flex;
    flex-direction: column; /* PENTING !! */
}

/* BUBBLE */
.message {
    display: block; /* INI FIX UTAMA */
    max-width: 70%;
    width: fit-content;
    padding: 12px 16px;
    margin-bottom: 14px;
    border-radius: 14px;
    font-size: 14.8px;
    line-height: 1.45;
    animation: fadeIn 0.15s ease-in-out;
    word-wrap: break-word;
}

/* Kanan (pengirim) */
.me {
    align-self: flex-end;     /* PENTING! */
    background: #0E6B50;
    color: white;
    border-bottom-right-radius: 6px;
}

/* Kiri (penerima) */
.other {
    align-self: flex-start;   /* PENTING! */
    background: #e8ecec;
    color: #222;
    border-bottom-left-radius: 6px;
}


/* NAMA PENGIRIM */
.message strong {
    font-size: 12.4px;
    opacity: 0.85;
    display: block;
    margin-bottom: 2px;
}

/* TIMESTAMP */
.message small {
    display: block;
    font-size: 11px;
    opacity: 0.65;
    margin-top: 6px;
    text-align: right;
}

/* INPUT AREA */
.chat-input {
    background: #ffffff;
    padding: 12px 16px;
    border-top: 1px solid #ddd;
    display: flex;
    gap: 10px;
    align-items: center;
}

.chat-input textarea {
    resize: none;
    height: 46px;
    border-radius: 12px;
    padding: 10px 12px;
    font-size: 14px;
    width: 100%;
    background: #f3f3f3;
    border: 1px solid #dcdcdc;
}

.chat-input button {
    border-radius: 12px;
    padding: 0 22px;
    height: 46px;
    font-weight: 600;
}

/* Animasi */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="chat-container">

    <!-- HEADER -->
    <div class="chat-header">
        💬 Chat dengan Penyedia Jasa
    </div>

    <!-- PESAN -->
    <div class="chat-box" id="chatBox">
        @foreach($messages as $msg)
        <div class="message {{ $msg->sender_id == auth()->id() ? 'me' : 'other' }}">
            <strong>{{ $msg->sender->name }}</strong>
            {{ $msg->message }}
            <small>{{ $msg->created_at->format('H:i') }}</small>
        </div>
        @endforeach
    </div>

    <!-- INPUT -->
    <form method="POST" action="{{ route('order.chat.send', $order->id) }}" class="chat-input">
        @csrf
        <textarea name="message" class="form-control" placeholder="Ketik pesan..." required></textarea>
        <button class="btn btn-success">Kirim</button>
    </form>

</div>

<script>
// Auto scroll ke bawah
const chatBox = document.getElementById('chatBox');
chatBox.scrollTop = chatBox.scrollHeight;
</script>

</x-layoutUser>
