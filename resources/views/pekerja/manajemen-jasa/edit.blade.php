<x-layoutJasa>

<style>
/* Sama seperti form tambah (copy exact for consistency) */
.form-card {
    width: 100%;
    max-width: 650px;
    background: #fff;
    padding: 26px;
    border-radius: 16px;
    border: 1px solid #dfe7e4;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.04);
    font-family: Inter, sans-serif;
    margin: 0 auto;
}

.form-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
}

.form-row { margin-bottom: 16px; }
.form-row label { font-weight: 600; margin-bottom: 6px; display:block; }

.form-row input,
.form-row textarea,
.form-row select {
    width: 100%;
    border-radius: 10px;
    padding: 12px;
    border: 1px solid #cddad5;
    font-size: 14px;
    transition: .2s;
}
.form-row input:focus,
.form-row textarea:focus,
.form-row select:focus {
    border-color: #0D5C4A;
    box-shadow: 0 0 5px rgba(13,92,74,.25);
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

/* preview */
.preview-img {
    width: 100px;
    height: 100px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #d1d5db;
    margin-bottom: 10px;
}

/* Buttons */
.form-btns {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 20px;
}

.btn-back {
    background: #e5e7eb;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    color: #334155;
}

.btn-save {
    background: #0D5C4A;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 600;
    color: white;
    transition: .2s;
}

.btn-save:hover {
    background: #09402e;
    transform: translateY(-2px);
}
</style>

<div class="container mx-auto mt-6">

    <div class="form-card">

        <h2 class="form-title">Edit Jasa</h2>

        <form action="{{ route('pekerja.manajemen-jasa.update', $jasa->id) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <label>Gambar</label>
                <img src="{{ asset('storage/'.$jasa->gambar) }}" 
                     id="previewImg" class="preview-img">
                <input type="file" name="gambar" accept="image/*" onchange="previewImage(event)">
            </div>

            <div class="form-row">
                <label>Nama Jasa</label>
                <input type="text" name="nama_jasa" value="{{ $jasa->nama_jasa }}" required>
            </div>

            <div class="form-row">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="3" required>{{ $jasa->deskripsi }}</textarea>
            </div>

            <div class="form-grid">
                <div class="form-row">
                    <label>Estimasi Waktu (hari)</label>
                    <input type="number" name="estimasi_waktu" value="{{ $jasa->estimasi_waktu }}" required>
                </div>

                <div class="form-row">
                    <label>Harga</label>
                    <input type="number" name="harga" value="{{ $jasa->harga }}" required>
                </div>
            </div>

            <div class="form-row">
                <label>Kategori</label>
                <select name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $k)
                        <option value="{{ $k->id }}" {{ $jasa->kategori_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-btns">
                <a href="{{ route('pekerja.manajemen-jasa.index') }}" class="btn-back">Batal</a>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>

        </form>

    </div>

</div>

<script>
function previewImage(event) {
    document.getElementById('previewImg').src = URL.createObjectURL(event.target.files[0]);
}
</script>

</x-layoutJasa>
