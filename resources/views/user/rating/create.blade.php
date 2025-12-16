<x-layoutUser title="Beri Rating">

<style>
    .rating-wrapper {
        max-width: 700px;
        margin: 72px auto;
        background: #ffffff;
        border-radius: 20px;
        padding: 36px 38px;
        box-shadow: 0 12px 34px rgba(0,0,0,0.08);
    }

    .rating-header {
        margin-bottom: 28px;
    }

    .rating-title {
        font-size: 22px;
        font-weight: 700;
        color: #0E6B50;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rating-subtitle {
        font-size: 14px;
        color: #6c757d;
        line-height: 1.6;
    }

    /* FORM */
    .form-group {
        margin-bottom: 22px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #344;
    }

    .star-select {
        width: 100%;
        height: 46px;
        font-weight: 600;
        border-radius: 12px;
    }

    textarea.form-control {
        width: 100%;
        border-radius: 12px;
        resize: none;
        padding: 10px 12px;
    }

    /* ACTIONS */
    .rating-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 18px;
        border-top: 1px solid #eee;
    }

    .btn-back {
        color: #0E6B50;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
    }

    .btn-back:hover {
        text-decoration: underline;
    }

    .btn-submit {
        background: linear-gradient(135deg, #0E6B50, #1abc9c);
        border: none;
        border-radius: 14px;
        padding: 12px 28px;
        font-weight: 600;
        color: white;
        font-size: 14px;
        transition: .25s ease;
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.15);
        opacity: .95;
    }
</style>

<div class="rating-wrapper">

    {{-- Header --}}
    <div class="rating-header">
        <div class="rating-title">⭐ Beri Rating Pekerja</div>
        <div class="rating-subtitle">
            Penilaian kamu membantu meningkatkan kualitas layanan dan kepercayaan pengguna ✨
        </div>
    </div>

    <form method="POST" action="{{ route('rating.store', $order->id) }}">
        @csrf

        {{-- Rating --}}
        <div class="form-group">
            <label class="form-label">Rating</label>
            <select name="rating" class="form-control star-select" required>
                <option value="" disabled selected>— Pilih Rating —</option>
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}">{{ $i }} ⭐</option>
                @endfor
            </select>
        </div>

        {{-- Review --}}
        <div class="form-group">
            <label class="form-label">Ulasan (opsional)</label>
            <textarea
                name="review"
                class="form-control"
                rows="4"
                placeholder="Ceritakan pengalamanmu dengan pekerja ini..."></textarea>
        </div>

        {{-- Actions --}}
        <div class="rating-actions">
            <a href="{{ route('user.orders') }}" class="btn-back">
                ← Kembali ke Pesanan Saya
            </a>

            <button type="submit" class="btn-submit">
                ⭐ Kirim Rating
            </button>
        </div>
    </form>

</div>

</x-layoutUser>
