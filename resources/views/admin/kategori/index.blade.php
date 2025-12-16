<x-layoutAdmin :title="$title">

<div class="kategori-container">

    <div class="header-section">
        <h3>{{ $title }}</h3>
        <a href="{{ route('admin.kategori.create') }}" class="btn-kategori-add">+ Tambah Kategori</a>
    </div>

    <div class="table-wrapper">
        <table class="kategori-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Icon</th>
                    <th>Nama Kategori</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategori as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>

                    <!-- Icon -->
                    <td>
                        @if ($item->icon)
                            <img src="{{ asset('storage/kategori/'.$item->icon) }}"
                                 alt="icon"
                                 style="width: 45px; height: 45px; object-fit: contain;">
                        @else
                            <span style="color:#aaa">Tidak ada</span>
                        @endif
                    </td>

                    <!-- Nama -->
                    <td>{{ $item->nama }}</td>


                    <!-- Aksi -->
                    <td class="action-btns">
                        <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn-edit">Edit</a>

                        <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="empty-state">
                    <td colspan="5">Belum ada kategori</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-layoutAdmin>
