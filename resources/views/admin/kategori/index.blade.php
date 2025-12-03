<x-layoutAdmin :title="$title">

<div class="kategori-container">

    <div class="header-section">
        <h3>{{ $title }}</h3>
        <a href="{{ route('kategori.create') }}" class="btn-kategori-add">+ Tambah Kategori</a>
    </div>

    <div class="table-wrapper">
        <table class="kategori-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td class="action-btns">
                        <a href="{{ route('kategori.edit', $item->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="empty-state">
                    <td colspan="4">Belum ada kategori</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</x-layoutAdmin>
