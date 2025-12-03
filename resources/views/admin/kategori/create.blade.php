<x-layoutAdmin :title="$title">

<div class="kategori-container">

    <div class="header-section">
        <h3>{{ $title }}</h3>
    </div>

    <div class="form-wrapper">

        <div class="form-card">
            <h3 class="form-title">Tambah Kategori</h3>

            <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="input-field" required>
                </div>

                <div class="form-group">
                    <label>Icon Kategori (optional)</label>
                    <input type="file" name="icon" accept="image/*" class="input-field">
                </div>

                <div class="form-actions">
                    <a href="{{ route('kategori.index') }}" class="btn-back">Kembali</a>
                    <button class="btn-save">Simpan</button>
                </div>
            </form>

        </div>

    </div>

</div>

</x-layoutAdmin>
