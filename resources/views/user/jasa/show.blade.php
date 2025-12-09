<x-layoutUser>

<div class="jasa-container">

    {{-- FOTO --}}
    <div class="jasa-img">
        <img src="{{ asset('storage/' . $jasa->gambar) }}" alt="{{ $jasa->nama_jasa }}">
    </div>

    {{-- DETAIL --}}
    <div class="jasa-info">

        <div class="jasa-title">{{ $jasa->nama_jasa }}</div>

        <div class="jasa-price">Rp {{ number_format($jasa->harga, 0, ',', '.') }}</div>

        <span class="badge-estimasi">
            ⏱ Estimasi: {{ $jasa->estimasi_waktu }} Jam
        </span>

        <div class="line"></div>

        <div class="jasa-desc">
            {!! nl2br(e($jasa->deskripsi)) !!}
        </div>

        {{-- Tombol Pesan --}}
        <button class="btn-order" onclick="window.location.href='{{ url('/checkout/' . $jasa->slug) }}'">
            <i class="fa-solid fa-shopping-cart"></i> Pesan Sekarang
        </button>

    </div>

</div>

</x-layoutUser>
