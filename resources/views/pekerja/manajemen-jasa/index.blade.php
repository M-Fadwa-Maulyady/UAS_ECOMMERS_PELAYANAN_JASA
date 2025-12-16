<x-layoutJasa>

<style>
    /* ===== Container ===== */
    .kategori-container {
        background: #fff;
        padding: 22px;
        border-radius: 16px;
        border: 1px solid #dfe7e4;
        box-shadow: 0px 4px 14px rgba(0,0,0,0.05);
    }

    /* ===== Header Title + Button ===== */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .header-section h3 {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }

    /* Button add */
    .btn-kategori-add {
        background: #0D5C4A;
        padding: 10px 18px;
        color: #fff;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        transition: .2s;
    }
    .btn-kategori-add:hover {
        background: #09402E;
        transform: translateY(-2px);
    }

    /* ===== Table ===== */
    .table-wrapper {
        overflow-x: auto;
    }

    .kategori-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        border-radius: 12px;
        overflow: hidden;
    }

    /* Table Header */
    .kategori-table thead {
        background: #0D5C4A;
    }
    .kategori-table th {
        color: white;
        padding: 14px;
        text-align: left;
        font-weight: 600;
        letter-spacing: .3px;
    }

    /* Table Body */
    .kategori-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #e6ece9;
    }

    /* Hover Effect */
    .kategori-table tbody tr:hover {
        background: #E8F8F2;
    }

    /* Empty Row */
    .empty-state td {
        text-align: center;
        padding: 18px;
        color: #6b7280;
        font-style: italic;
    }

    /* ===== Buttons (Edit/Delete) ===== */
    .action-btns {
        display: flex;
        gap: 10px;
    }

    .btn-edit {
        background: #2563eb;
        color: white !important;
        padding: 6px 12px;
        border-radius: 6px;
        transition: .2s;
    }
    .btn-edit:hover {
        background: #1e40af;
    }

    .btn-delete {
        background: #dc2626;
        color: white !important;
        padding: 6px 12px;
        border-radius: 6px;
        transition: .2s;
    }
    .btn-delete:hover {
        background: #991b1b;
    }
</style>

<div class="kategori-container">

    {{-- Header --}}
    <div class="header-section">
        <h3>Manajemen Jasa</h3>

        <a href="{{ route('pekerja.manajemen-jasa.create') }}" class="btn-kategori-add">
            + Tambah Jasa
        </a>
    </div>

    {{-- Flash Success --}}
    @if (session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="table-wrapper">
        <table class="kategori-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Jasa</th>
                    <th>Deskripsi</th>
                    <th>Estimasi</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($jasa as $j)
                <tr>

                    {{-- Gambar --}}
                    <td>
                        @if ($j->gambar)
                            <img src="{{ asset('storage/'.$j->gambar) }}"
                                 style="width:55px; height:55px; border-radius:8px; object-fit:cover;">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    {{-- Nama --}}
                    <td>{{ $j->nama_jasa }}</td>

                    {{-- Deskripsi --}}
                    <td>{{ Str::limit($j->deskripsi, 60) }}</td>

                    {{-- Estimasi --}}
                    <td>{{ $j->estimasi_waktu }} hari</td>

                    {{-- Harga --}}
                    <td>Rp {{ number_format($j->harga, 0, ',', '.') }}</td>

                    {{-- Kategori --}}
                    <td>
                        @if($j->kategori)
                            {{ $j->kategori->nama }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td>
                        <div class="action-btns">

                            <a href="{{ route('pekerja.manajemen-jasa.edit', $j->id) }}" 
                               class="btn-edit">
                                ✏ Edit
                            </a>

                            <form action="{{ route('pekerja.manajemen-jasa.destroy', $j->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin hapus jasa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">
                                    Hapus
                                </button>
                            </form>


                        </div>
                    </td>

                </tr>
                @empty
                <tr class="empty-state">
                    <td colspan="7">Belum ada jasa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

</x-layoutJasa>
