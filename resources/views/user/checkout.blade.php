<x-layoutUser :title="'Checkout - '.$jasa->nama">

<div class="checkout-wrapper">

    <h2 class="checkout-title">Checkout Layanan</h2>

    <div class="checkout-card">

        {{-- Bagian Detail Jasa --}}
        <div class="checkout-info">
            <img src="{{ asset('storage/' . $jasa->gambar) }}" class="checkout-img" alt="{{ $jasa->nama }}">

            <div class="checkout-detail">
                <h3>{{ ucfirst($jasa->nama) }}</h3>
                <p class="price">Rp {{ number_format($jasa->harga, 0, ',', '.') }}</p>
                <p><strong>Estimasi:</strong> {{ $jasa->estimasi }} Jam</p>
                <p class="desc">{{ $jasa->deskripsi }}</p>
            </div>
        </div>

        {{-- Form Checkout --}}
        <form action="{{ route('checkout.store', $jasa->id) }}" method="POST" class="checkout-form">
            @csrf

            <label>Alamat Service <span style="color:red">*</span></label>
            <textarea name="alamat" placeholder="Masukkan alamat lengkap..." required>{{ old('alamat') }}</textarea>

            <label>Tanggal Booking <span style="color:red">*</span></label>
            <input type="date" name="tanggal" min="{{ date('Y-m-d') }}" required>

            <button type="submit" class="btn-submit">
                Konfirmasi Pesanan
            </button>
        </form>

    </div>

</div>

{{-- Optional CSS biar rapi --}}
<style>
.checkout-wrapper {
    max-width: 850px;
    margin: 30px auto;
    padding: 20px;
}

.checkout-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
}

.checkout-card {
    background: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-radius: 10px;
    padding: 20px;
}

.checkout-info {
    display: flex;
    gap: 20px;
    margin-bottom: 25px;
}

.checkout-img {
    width: 200px;
    border-radius: 10px;
    object-fit: cover;
}

.checkout-detail h3 {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
}

.price {
    color: #0f9d58;
    font-size: 18px;
    margin: 6px 0;
    font-weight: 600;
}

.checkout-form input,
.checkout-form textarea {
    width: 100%;
    padding: 12px;
    margin-top: 5px;
    border: 1px solid #c9c9c9;
    border-radius: 8px;
}

.checkout-form textarea {
    height: 100px;
    resize: none;
}

.btn-submit {
    width: 100%;
    background: #0f8450;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 8px;
    margin-top: 18px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
}

.btn-submit:hover {
    background: #0c6b3e;
}
</style>

</x-layoutUser>
