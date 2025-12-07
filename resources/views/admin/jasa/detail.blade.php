<x-layoutAdmin :title="'Detail Jasa'">

<div class="card p-4" style="max-width:800px; margin:auto;">

    <h3 class="fw-bold mb-3">{{ $jasa->nama_jasa }}</h3>

    <img src="{{ asset('storage/' . $jasa->gambar) }}" 
         class="img-fluid mb-3" 
         style="border-radius:10px; max-height:280px; object-fit:cover;">

    <p><strong>Pekerja:</strong> {{ $jasa->user->name }}</p>
    <p><strong>Kategori:</strong> {{ $jasa->kategori->nama }}</p>
    <p><strong>Deskripsi:</strong><br>{{ $jasa->deskripsi }}</p>
    <p><strong>Estimasi Waktu:</strong> {{ $jasa->estimasi_waktu }} hari</p>
    <p><strong>Harga:</strong> Rp {{ number_format($jasa->harga,0,',','.') }}</p>

    @if($jasa->status == 2)
      <p class="text-danger">
        <strong>Alasan penolakan:</strong><br>
        {{ $jasa->alasan_tolak }}
      </p>
    @endif

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('admin.jasa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

</x-layoutAdmin>
