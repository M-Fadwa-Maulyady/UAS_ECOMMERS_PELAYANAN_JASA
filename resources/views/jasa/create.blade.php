@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('detail-jasa/jasa.css')}}">

<div class="form-container">
  <h2>Tambah Jasa Baru</h2>

  <form action="{{ route('jasa.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
    @csrf
    <label>Nama Jasa:</label>
    <input type="text" name="nama" required>

    <label>Deskripsi:</label>
    <textarea name="deskripsi" rows="4" required></textarea>

    <label>Harga:</label>
    <input type="number" name="harga" step="0.01">

    <label>Durasi:</label>
    <input type="text" name="durasi">

    <label>Kontak:</label>
    <input type="text" name="kontak">

    <label>Gambar:</label>
    <input type="file" name="gambar" accept="image/*">

    <button type="submit" class="btn-submit">Simpan</button>
    <a href="{{ route('jasa.index') }}" class="btn-back">Kembali</a>
  </form>
</div>
@endsection
