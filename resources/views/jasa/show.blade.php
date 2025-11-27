@extends('layouts.app')

@section('title', $jasa->nama)

@section('content')
<div class="jasa-detail">
    <h1>{{ $jasa->nama }}</h1>
    <img src="{{ asset('storage/' . $jasa->gambar) }}" alt="{{ $jasa->nama }}" style="max-width:100%; height:auto;">
    <p>{{ $jasa->deskripsi }}</p>
    <p><strong>Harga:</strong> {{ $jasa->harga ?? 'Hubungi admin' }}</p>
    <a href="{{ route('landing') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
