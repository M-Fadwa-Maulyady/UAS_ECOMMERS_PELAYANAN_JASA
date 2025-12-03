<x-layoutAdmin :title="$title">

<div class="kategori-container">

    <div class="header-section">
        <h3>{{ $title }}</h3>
    </div>

    <div class="form-wrapper">

        <div class="form-card">
            <h3 class="form-title">Edit Kategori</h3>

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="input-field" value="{{ $kategori->nama }}" required>
                </div>

                <!-- Preview Icon Lama -->
                <div class="form-group">
                    <label>Icon Saat Ini</label><br>

                    @if ($kategori->icon)
                        <img src="{{ asset('storage/kategori/'.$kategori->icon) }}"
                             alt="icon"
                             style="width: 60px; height: 60px; object-fit: contain; border:1px solid #ddd; padding:4px; border-radius:6px;">
                    @else
                        <p style="color:#aaa">Belum ada icon</p>
                    @endif
                </div>

                <!-- Upload Icon Baru -->
                <div class="form-group">
                    <label>Ganti Icon (optional)</label>
                    <input type="file" name="icon" accept="image/*" class="input-field">
                </div>

                <div class="form-actions">
                    <a href="{{ route('kategori.index') }}" class="btn-back">Kembali</a>
                    <button class="btn-update">Update</button>
                </div>

            </form>
        </div>

    </div>

</div>

</x-layoutAdmin>
