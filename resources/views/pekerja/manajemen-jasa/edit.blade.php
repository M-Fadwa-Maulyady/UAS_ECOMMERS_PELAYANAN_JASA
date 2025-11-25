<x-layoutJasa>

<style>
.form-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 24px;
    max-width: 700px;
    margin: 0 auto;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    font-family: Inter, sans-serif;
}

.form-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 18px;
}

.form-row label {
    font-weight: 600;
    margin-bottom: 6px;
}

.form-row input,
.form-row textarea {
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    width: 100%;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.preview-img {
    width: 90px;
    height: 90px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #d1d5db;
    margin-bottom: 10px;
}

.form-btns {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

.btn-cancel {
    background: #e5e7eb;
    color: #374151;
}

.btn-save {
    background: #2563eb;
    color: #fff;
}
</style>

<div class="container mx-auto mt-6">
    
    <h2 class="text-2xl font-semibold mb-6">Edit Jasa</h2>

    <div class="form-card">

        <form action="{{ route('pekerja.manajemen-jasa.update', $jasa->id) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Gambar --}}
            <div class="form-row">
                <label>Gambar</label>

                <img src="{{ asset('storage/'.$jasa->gambar) }}" 
                     id="previewImg"
                     class="preview-img">

                <input type="file" 
                       name="gambar" 
                       accept="image/*"
                       onchange="previewImage(event)">
            </div>

            {{-- Nama jasa --}}
            <div class="form-row">
                <label>Nama Jasa</label>
                <input type="text" 
                       name="nama_jasa" 
                       value="{{ $jasa->nama_jasa }}"
                       required>
            </div>

            {{-- Deskripsi --}}
            <div class="form-row">
                <label>Deskripsi</label>
                <textarea name="deskripsi" 
                          rows="3"
                          required>{{ $jasa->deskripsi }}</textarea>
            </div>

            {{-- Grid 2 kolom --}}
            <div class="form-grid">

                <div class="form-row">
                    <label>Estimasi Waktu (hari)</label>
                    <input type="number" 
                           name="estimasi_waktu" 
                           value="{{ $jasa->estimasi_waktu }}"
                           required>
                </div>

                <div class="form-row">
                    <label>Harga</label>
                    <input type="number" 
                           name="harga" 
                           value="{{ $jasa->harga }}"
                           required>
                </div>

            </div>

            {{-- Revisi --}}
            <div class="form-row">
                <label>Jumlah Revisi</label>
                <input type="number" 
                       name="jumlah_revisi" 
                       value="{{ $jasa->jumlah_revisi }}"
                       required>
            </div>

            {{-- Buttons --}}
            <div class="form-btns">
                <a href="{{ route('pekerja.manajemen-jasa.index') }}" class="btn btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn btn-save">
                    Simpan Perubahan
                </button>
            </div>

        </form>

    </div>

</div>

<script>
function previewImage(event) {
    let output = document.getElementById('previewImg');
    output.src = URL.createObjectURL(event.target.files[0]);
}
</script>

</x-layoutJasa>
