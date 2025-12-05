<x-layoutAdmin :title="$title">

<style>
.detail-card {
    background: #fff;
    padding: 26px;
    border-radius: 16px;
    border: 1px solid #e6e6e6;
    max-width: 900px;
    margin: 0 auto;
    font-family: 'Inter', sans-serif;
}

.section-title {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 12px;
    border-left: 5px solid #0f5132;
    padding-left: 10px;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.info-item {
    padding: 10px 0;
}

.info-label {
    font-weight: 600;
    color: #444;
    font-size: 14px;
}

.info-value {
    font-size: 15px;
    color: #111;
}

.badge-status {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
}

.badge-verified {
    background: #d1fae5;
    color: #065f46;
}

.badge-pending {
    background: #fff3cd;
    color: #856404;
}

.preview-doc {
    width: 220px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #d1d1d1;
}

.action-row {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.btn-approve {
    background: #198754;
    color: white;
    padding: 9px 16px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}
.btn-approve:hover { background: #146c43; }

.btn-reject {
    background: #dc3545;
    color: white;
    padding: 9px 16px;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}
.btn-reject:hover { background: #b02a37; }

.btn-back {
    margin-top: 30px;
    display: inline-block;
    text-decoration: none;
    font-weight: 600;
    padding: 10px 16px;
    color: #444;
    border-radius: 8px;
    background: #f1f1f1;
}
.btn-back:hover { background: #e4e4e4; }
</style>

<div class="detail-card">

    <h3 class="mb-3 fw-bold">Detail Pekerja</h3>

    {{-- Status --}}
    <p>
        @if($worker->is_verified_by_admin)
            <span class="badge-status badge-verified">✔ Terverifikasi</span>
        @else
            <span class="badge-status badge-pending">⏳ Menunggu Verifikasi Admin</span>
        @endif
    </p>

    <hr class="my-3">

    {{-- Informasi pribadi --}}
    <div class="section-title">Informasi Pribadi</div>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-label">Nama</div>
            <div class="info-value">{{ $worker->name }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">Email</div>
            <div class="info-value">{{ $worker->email }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">Alamat</div>
            <div class="info-value">{{ $worker->alamat ?? '-' }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">Nomor Telepon</div>
            <div class="info-value">{{ $worker->no_telp ?? '-' }}</div>
        </div>
    </div>

    <hr class="my-4">

    {{-- Usaha --}}
    <div class="section-title">Informasi Usaha</div>

    <div class="info-grid">
        <div class="info-item">
            <div class="info-label">Nama Usaha</div>
            <div class="info-value">{{ $worker->nama_usaha ?? '-' }}</div>
        </div>

        <div class="info-item">
            <div class="info-label">Kategori Jasa</div>
            <div class="info-value">{{ $worker->kategori_jasa ?? '-' }}</div>
        </div>
    </div>

    <div class="info-item mt-2">
        <div class="info-label">Deskripsi Jasa</div>
        <div class="info-value">{{ $worker->deskripsi_jasa ?? '-' }}</div>
    </div>

    <hr class="my-4">

    {{-- Dokumen --}}
    <div class="section-title">Dokumen Verifikasi</div>

    @if($worker->ktp)
        <img src="{{ asset('storage/' . $worker->ktp) }}" class="preview-doc" alt="KTP">
    @else
        <p class="text-muted">❌ Belum mengupload dokumen.</p>
    @endif

    {{-- Aksi --}}
    @if(!$worker->is_verified_by_admin)
    <div class="action-row">
        <form action="{{ route('admin.pekerja.update-status', $worker->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="approved">
            <button class="btn-approve">Setujui</button>
        </form>

        <form action="{{ route('admin.pekerja.update-status', $worker->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="reject">
            <button class="btn-reject">Tolak</button>
        </form>
    </div>
    @endif

    <a href="{{ route('admin.pekerja.index') }}" class="btn-back">← Kembali</a>

</div>

</x-layoutAdmin>
