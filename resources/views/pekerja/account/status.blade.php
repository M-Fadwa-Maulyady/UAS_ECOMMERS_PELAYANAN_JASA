<x-layoutJasa>

<style>
/* =======================
   CARD UTAMA
======================= */
.status-page {
    max-width: 700px;
    margin: 20px auto;
    background: #ffffff;
    padding: 28px;
    border-radius: 18px;
    border: 1px solid #e3ebe7;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

/* =======================
   HEADER
======================= */
.status-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 18px;
}

.status-header .icon {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    background: #0d5c4a;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
}

.status-header h2 {
    font-size: 22px;
    font-weight: 700;
    color: #0d3d30;
    margin: 0;
}

/* =======================
   PROGRESS BAR
======================= */
.progress-box {
    margin-top: 15px;
    margin-bottom: 20px;
}

.progress-label {
    font-weight: 600;
    font-size: 14px;
    color: #0d3d30;
    margin-bottom: 5px;
}

.progress-bar {
    width: 100%;
    height: 12px;
    background: #dce9e4;
    border-radius: 10px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #0d5c4a;
    border-radius: 10px;
    transition: 0.3s;
}

/* =======================
   STATE BOXES
======================= */
.state-box {
    background: #fffef3;
    padding: 16px;
    border-left: 4px solid #fcd34d;
    color: #614a00;
    border-radius: 12px;
    margin-bottom: 20px;
    font-size: 14px;
}

.state-pending {
    background: #f0f7ff;
    border-left: 4px solid #3b82f6;
    color: #0f3c87;
}

.state-approved {
    background: #ecfdf4;
    border-left: 4px solid #10b981;
    color: #064e3b;
}

/* =======================
   CHECKLIST
======================= */
.checklist {
    list-style: none;
    padding: 0;
    margin: 0 0 25px 0;
}

.checklist li {
    padding: 10px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #444;
}

.checklist li i {
    width: 22px;
    text-align: center;
}

.checklist li a {
    color: inherit;
    text-decoration: none;
}

.checklist li.done {
    color: #0d5c4a;
    font-weight: 600;
}

/* =======================
   BUTTONS
======================= */
.btn-verify,
.btn-open {
    display: block;
    width: 100%;
    padding: 12px;
    background: #0d5c4a;
    color: white;
    border-radius: 10px;
    font-weight: 600;
    text-align: center;
    font-size: 15px;
    margin-top: 10px;
    transition: .2s;
}

.btn-verify:hover,
.btn-open:hover {
    background: #094a3a;
    transform: translateY(-1px);
}
</style>

@php
    $progress = 0;

    if ($user->ktp) $progress += 33;
    if ($user->profile_filled) $progress += 33;

    // Rekening lengkap jika 3 kolom terisi
    if ($user->rekening_bank && $user->rekening_nama && $user->rekening_nomor) {
        $progress += 34;
    }

    $percentage = min(100, $progress);
@endphp

<div class="status-page">

    {{-- HEADER --}}
    <div class="status-header">
        <div class="icon">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <h2>Status Akun Pekerja</h2>
    </div>

    {{-- PROGRESS --}}
    <div class="progress-box">
        <div class="progress-label">{{ $percentage }}% Selesai</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $percentage }}%"></div>
        </div>
    </div>

    {{-- STATE --}}
    @if(!$user->is_verified_by_admin)

        <div class="state-box">
            ⚠ Akun kamu belum diverifikasi admin.  
            Lengkapi semua persyaratan untuk mulai berjualan.
        </div>

        <ul class="checklist">

            <li class="{{ $user->ktp ? 'done' : '' }}">
                <i class="fa-solid fa-id-card"></i>
                <a href="{{ route('pekerja.account.ktp') }}">Upload KTP</a>
            </li>

            <li class="{{ $user->profile_filled ? 'done' : '' }}">
                <i class="fa-solid fa-user-check"></i>
                <a href="{{ route('pekerja.account.profile') }}">Lengkapi Profil</a>
            </li>

            <li class="{{ ($user->rekening_bank && $user->rekening_nama && $user->rekening_nomor) ? 'done' : '' }}">
                <i class="fa-solid fa-building-columns"></i>
                <a href="{{ route('pekerja.account.rekening') }}">Tambah Rekening</a>
            </li>

        </ul>

      <form action="{{ route('pekerja.account.submit') }}" method="POST">
    @csrf
    <button type="submit" class="btn-verify">
        Ajukan Verifikasi
    </button>
</form>



    @elseif($user->is_verified_by_admin && !$user->is_pro_active)

        <div class="state-box state-pending">
            ⏳ Dokumen kamu sudah diajukan.  
            Sedang menunggu persetujuan admin.
        </div>

    @else

        <div class="state-box state-approved">
            ✔ Akun kamu sudah diverifikasi admin!  
            Kamu sudah bisa mulai berjualan 🎉
        </div>

        <a href="{{ route('pekerja.manajemen-jasa.index') }}" class="btn-open">
            Mulai Jualan
        </a>

    @endif

</div>

</x-layoutJasa>
