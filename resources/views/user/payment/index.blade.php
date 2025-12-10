<x-layoutUser title="Pembayaran">

<style>
.container-pay {
    max-width: 480px;
    margin: 50px auto;
    background: #ffffff;
    padding: 28px;
    border-radius: 18px;
    box-shadow: 0px 5px 20px rgba(0,0,0,0.07);
}

.title-pay {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #0E6B50;
}

.info-box {
    background: #f8fff5;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 18px;
    border: 1px solid #d9f1d2;
}

.bank-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f7f7f7;
    padding: 12px 15px;
    border-radius: 10px;
    cursor: pointer;
    margin-bottom: 10px;
    transition: .2s;
    border: 1px solid transparent;
}

.bank-option:hover {
    background: #eaffef;
    border-color: #0E6B50;
}

.bank-label {
    display: flex;
    gap: 8px;
    align-items: center;
}

.bank-radio {
    transform: scale(1.3);
}

.btn-pay {
    width: 100%;
    background: #0E6B50;
    color: #fff;
    border: none;
    padding: 14px;
    margin-top: 15px;
    border-radius: 12px;
    font-size: 17px;
    cursor:pointer;
    transition: .2s;
}

.btn-pay:hover {
    opacity: .8;
}
</style>

<div class="container-pay">

    <div class="title-pay">💳 Pembayaran</div>

    {{-- Order Summary --}}
    <div class="info-box">
    <p><strong>Jasa:</strong> {{ $order->jasa->nama_jasa }}</p>
    <p><strong>Total Dibayar:</strong>
        <span style="color:#0E6B50;font-weight:bold;">
            Rp {{ number_format($order->jasa->harga, 0, ',', '.') }}
        </span>
    </p>

    {{-- Hitungan fee --}}
    @php
        $total = $order->jasa->harga;
        $fee = $total * 0.10;
        $worker = $total - $fee;
    @endphp
</div>



    <form action="{{ route('payment.store', $order->id) }}" method="POST">
        @csrf
        <h5 style="font-weight:600;margin-bottom:10px;">Metode Pembayaran</h5>

        <label class="bank-option">
            <span class="bank-label">🏦 BCA</span>
            <input type="radio" name="payment_method" value="BCA" class="bank-radio" required>
        </label>
        
        <label class="bank-option">
            <span class="bank-label">🏦 BRI</span>
            <input type="radio" name="payment_method" value="BRI" class="bank-radio">
        </label>

        <label class="bank-option">
            <span class="bank-label">🏦 BNI</span>
            <input type="radio" name="payment_method" value="BNI" class="bank-radio">
        </label>

        <label class="bank-option">
            <span class="bank-label">🏦 Mandiri</span>
            <input type="radio" name="payment_method" value="Mandiri" class="bank-radio">
        </label>

        <label class="bank-option">
            <span class="bank-label">🏦 CIMB</span>
            <input type="radio" name="payment_method" value="CIMB" class="bank-radio">
        </label>

        <button type="submit" class="btn-pay">Lanjutkan</button>

    </form>
</div>

</x-layoutUser>
