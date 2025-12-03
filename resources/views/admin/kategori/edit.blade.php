<x-layoutAdmin :title="$title">

<div class="form-wrapper">

    <div class="form-card">
        <h3 class="form-title">Edit Kategori</h3>

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama" class="input-field" value="{{ $kategori->nama }}" required>
            </div>

            <div class="form-group">
                <label>Deskripsi (optional)</label>
                <textarea name="deskripsi" class="input-field textarea">{{ $kategori->deskripsi }}</textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('kategori.index') }}" class="btn-back">Kembali</a>
                <button class="btn-update">Update</button>
            </div>
        </form>
    </div>

</div>

</x-layoutAdmin>
