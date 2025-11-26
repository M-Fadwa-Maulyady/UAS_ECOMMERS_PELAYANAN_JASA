@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Jasa</h1>

    @forelse($jasas as $jasa)
        <div class="jasa-card">
            <h2>{{ $jasa->nama }}</h2>
            @if($jasa->gambar)
                <img src="{{ asset('storage/' . $jasa->gambar) }}" alt="{{ $jasa->nama }}" width="200">
            @endif
            <p>{{ \Illuminate\Support\Str::limit($jasa->deskripsi, 100) }}...</p>
            <button onclick="window.location.href='{{ route('jasa.show', $jasa->slug) }}'">Read More</button>
        </div>
    @empty
        <p>Belum ada jasa tersedia.</p>
    @endforelse
</div>
@endsection
