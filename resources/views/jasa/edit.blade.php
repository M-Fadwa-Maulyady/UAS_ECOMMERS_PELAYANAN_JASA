@extends('layouts.app')

@section('content')
<link rel="{{ asset('detail-jasa/jasa.css') }}">

<div class="form-container">
  <h2>Edit Jasa: {{ $jasa->nama }}</h2>

  <form action="{{ route('jasa.update', $jasa->id) }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @csrf
    @method('PUT')

    <label>Nama Jasa:</label>
    <input type="text" name="nama" value="{{ $jasa->nama }}" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi" rows="4" required>{{ $jasa->deskripsi }}</textarea>

    <label>Harga:</label>
    <input type="number" name="harga" step="0.01" value="{{ $jasa->harga }}">

    <label>Durasi:</label>
    <input type="text" name="durasi" value="{{ $jasa->durasi }}">

    <label>Kontak:</label>
    <input type="text" name="kontak" value="{{ $jasa->kontak }}">

    <label>Gambar (biarkan kosong jika tidak diganti):</label>
    <input type="file" name="gambar" accept="image/*">

    @if($jasa->gambar)
      <img src="{{ asset('storage/'.$jasa->gambar) }}" alt="{{ $jasa->nama }}" width="150" style="margin-top:10px;border-radius:8px;">
    @endif

    <button type="submit" class="btn-submit">Update</button>
    <a href="{{ route('jasa.index') }}" class="btn-back">Kembali</a>
  </form>
</div>
@endsection
