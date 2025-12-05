<x-layoutAdmin :title="$title">

<link rel="stylesheet" href="{{ asset('css/admin_pekerja.css') }}">

<style>
.table-custom {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.table-custom thead tr {
    background: #0a5745;
    color: white;
}

.table-custom thead th {
    padding: 14px;
    font-weight: 600;
    text-align: left;
}

.table-custom tbody tr {
    background: #f8faf9;
    transition: .25s ease;
    border-radius: 10px;
}

.table-custom tbody tr:hover {
    background: #eef5f1;
}

.table-custom td {
    padding: 16px;
    vertical-align: middle;
}

.badge-status {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
    display: inline-block;
}

.verified {
    background: #d1fae5;
    color: #065f46;
}

.pending {
    background: #fff3cd;
    color: #946200;
}

.table-actions {
    display: flex;
    gap: 10px;
}

.btn-view, .btn-approve, .btn-delete {
    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 6px;
}

.btn-view {
    background: #2979ff;
    color: #fff;
}
.btn-view:hover { background: #165fcc; }

.btn-approve {
    background: #25a244;
    color: white;
}
.btn-approve:hover { background: #198039; }

.btn-delete {
    background: #e53935;
    color: white;
}
.btn-delete:hover { background: #b62524; }

.empty {
    text-align: center;
    padding: 18px;
    font-size: 15px;
    color: #777;
}
</style>

<div class="card p-4">

    <h4 class="mb-3 fw-bold">Manajemen Pekerja</h4>

    <table class="table-custom user-table">
        <thead>
        <tr>
            <th width="60">No</th>
            <th width="200">Nama</th>
            <th width="260">Email</th>
            <th width="150">Status</th>
            <th width="200">Aksi</th>
        </tr>
        </thead>

        <tbody>
        @forelse($workers as $key => $worker)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $worker->name }}</td>
                <td>{{ $worker->email }}</td>

                <td>
                    @if($worker->is_verified_by_admin)
                        <span class="badge-status verified">✔ Terverifikasi</span>
                    @else
                        <span class="badge-status pending">⏳ Menunggu Verifikasi</span>
                    @endif
                </td>

                <td>
                    <div class="table-actions">

                        {{-- Detail --}}
                        <a href="{{ route('admin.pekerja.show', $worker->id) }}" class="btn-view">Detail</a>

                        {{-- Approve hanya jika data lengkap --}}
                        @if(!$worker->is_verified_by_admin && $worker->ktp && $worker->profile_filled)
                            <form action="{{ route('admin.pekerja.update-status', $worker->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="approved">
                                <button class="btn-approve">Approve</button>
                            </form>
                        @elseif(!$worker->is_verified_by_admin)
                            <span style="font-size:12px; color:#777;">❌ Belum lengkap</span>
                        @endif

                        {{-- Delete --}}
                        <form action="{{ route('admin.pekerja.delete', $worker->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus pekerja ini?')" class="btn-delete">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="empty">Belum ada pekerja menunggu verifikasi</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

</x-layoutAdmin>
