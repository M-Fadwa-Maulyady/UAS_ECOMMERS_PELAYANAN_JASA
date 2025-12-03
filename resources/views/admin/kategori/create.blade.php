<x-layoutAdmin :title="$title">

<div class="form-wrapper">

    <div class="form-card">
        <h3 class="form-title">Tambah Kategori</h3>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama" class="input-field" required>
            </div>

            <div class="form-group">
                <label>Deskripsi (optional)</label>
                <textarea name="deskripsi" class="input-field textarea"></textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('kategori.index') }}" class="btn-back">Kembali</a>
                <button class="btn-save">Simpan</button>
            </div>
        </form>
    </div>

</div>

</x-layoutAdmin>
