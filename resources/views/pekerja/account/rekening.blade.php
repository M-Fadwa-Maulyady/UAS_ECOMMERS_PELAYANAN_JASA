<x-layoutJasa>

<style>
.form-card {
    max-width: 650px;
    margin: 25px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 16px;
    border: 1px solid #e5ece8;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

.form-title {
    font-size: 22px;
    font-weight: 700;
    color: #0d3d30;
    margin-bottom: 18px;
}

.form-row {
    margin-bottom: 16px;
}

.form-row label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.form-row input,
.form-row select {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #d3ddd7;
    font-size: 15px;
}

.btn-save {
    width: 100%;
    padding: 12px;
    background: #0d5c4a;
    color: white;
    font-weight: 600;
    border-radius: 10px;
    font-size: 16px;
    transition: .2s;
}

.btn-save:hover {
    background: #094a3a;
}
</style>

<div class="form-card">

    <div class="form-title">Tambah Rekening Bank</div>

    <form action="{{ route('pekerja.account.rekening.update') }}" method="POST">
        @csrf

        <div class="form-row">
            <label>Bank</label>
            <select name="rekening_bank" required>
                <option value="">-- Pilih Bank --</option>
                <option value="BCA" {{ $user->rekening_bank == 'BCA' ? 'selected' : '' }}>BCA</option>
                <option value="BRI" {{ $user->rekening_bank == 'BRI' ? 'selected' : '' }}>BRI</option>
                <option value="BNI" {{ $user->rekening_bank == 'BNI' ? 'selected' : '' }}>BNI</option>
                <option value="Mandiri" {{ $user->rekening_bank == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                <option value="CIMB" {{ $user->rekening_bank == 'CIMB' ? 'selected' : '' }}>CIMB</option>
            </select>
        </div>

        <div class="form-row">
            <label>Nama Pemilik Rekening</label>
            <input type="text" name="rekening_nama" 
                   value="{{ $user->rekening_nama }}" required>
        </div>

        <div class="form-row">
            <label>Nomor Rekening</label>
            <input type="text" name="rekening_nomor" 
                   value="{{ $user->rekening_nomor }}" required>
        </div>

        <button class="btn-save">Simpan Rekening</button>

    </form>
</div>

</x-layoutJasa>
