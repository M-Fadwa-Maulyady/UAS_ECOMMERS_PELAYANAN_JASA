<x-layoutUser title="Upload Bukti Pembayaran">

<style>
    .upload-card {
        max-width: 500px;
        margin: 40px auto;
        background: #ffffff;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .upload-card h3 {
        font-weight: 600;
        margin-bottom: 15px;
    }

    .label-info {
        font-size: 14px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .info-box {
        background: #E5FFF1;
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 15px;
        border-left: 5px solid #0E6B50;
    }

    button {
        background:#0E6B50;
        border:none;
        padding: 12px;
        color:white;
        border-radius:8px;
        cursor:pointer;
        width:100%;
        font-size:15px;
        transition: .2s;
    }

    button:hover {
        opacity: .85;
    }

</style>

<div class="upload-card">

    <h3>📤 Upload Bukti Pembayaran</h3>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Informasi Order --}}
    <div class="info-box">
        <p><strong>Nama Jasa:</strong> {{ $payment->order->jasa->nama_jasa }}</p>
        <p><strong>Total Dibayar:</strong> Rp {{ number_format($payment->total) }}</p>
    </div>

    {{-- Form Upload --}}
    <form action="{{ route('payment.upload', $payment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label class="label-info">📎 Pilih Bukti Transfer</label>
        <input type="file" name="bukti" class="form-control mb-2" required>

        @error('bukti')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <button type="submit">Kirim Bukti</button>
    </form>

</div>

</x-layoutUser>
