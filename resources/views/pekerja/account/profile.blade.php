<x-layoutJasa>

<style>
.profile-card {
    max-width: 650px;
    margin: 20px auto;
    padding: 26px;
    background: #fff;
    border-radius: 18px;
    border: 1px solid #dfe7e4;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

.profile-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 18px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

input, textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 10px;
    border: 1px solid #cddad5;
    font-size: 14px;
}

textarea {
    min-height: 90px;
    resize: vertical;
}

.btn-save {
    width: 100%;
    background: #0d5c4a;
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

.btn-save:hover {
    background: #094a3a;
}
</style>

<div class="profile-card">

    <div class="profile-title">Lengkapi Profil Pekerja</div>

    <form action="{{ route('pekerja.account.profile.update') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $user->alamat }}" required>
        </div>

        <div class="form-group">
            <label>No. Telepon</label>
            <input type="text" name="no_telp" value="{{ $user->no_telp }}" required>
        </div>

        <div class="form-group">
            <label>Nama Usaha</label>
            <input type="text" name="nama_usaha" value="{{ $user->nama_usaha }}" required>
        </div>

        <div class="form-group">
            <label>Kategori Jasa</label>
            <input type="text" name="kategori_jasa" value="{{ $user->kategori_jasa }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi Jasa</label>
            <textarea name="deskripsi_jasa" required>{{ $user->deskripsi_jasa }}</textarea>
        </div>

        <button class="btn-save">Simpan Profil</button>
    </form>

</div>

</x-layoutJasa>
