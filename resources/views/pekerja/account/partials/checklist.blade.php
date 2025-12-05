
    <ul class="checklist">

    {{-- KTP --}}
    <li class="{{ $user->ktp ? 'done' : '' }}">
        <i class="fa-solid {{ $user->ktp ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
        <a href="{{ route('pekerja.account.ktp') }}">
            Unggah Foto KTP
        </a>
    </li>

    {{-- PROFIL --}}
    <li class="{{ $user->profile_filled ? 'done' : '' }}">
        <i class="fa-solid {{ $user->profile_filled ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
        <a href="{{ route('pekerja.account.profile') }}">
            Lengkapi Profil
        </a>
    </li>

    {{-- REKENING --}}
    <li class="{{ ($user->rekening_bank && $user->rekening_nama && $user->rekening_nomor) ? 'done' : '' }}">
        <i class="fa-solid {{ ($user->rekening_bank && $user->rekening_nama && $user->rekening_nomor) ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
        <a href="{{ route('pekerja.account.rekening') }}">
            Tambahkan Rekening Bank
        </a>
    </li>

</ul>

