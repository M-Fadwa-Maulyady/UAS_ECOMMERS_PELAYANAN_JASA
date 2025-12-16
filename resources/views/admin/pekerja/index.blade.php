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

    .badge-wait {
        background: #fff3cd;
        color: #946200;
    }

    .badge-submitted {
        background: #cfe2ff;
        color: #084298;
    }

    .badge-rejected {
        background: #fde2e1;
        color: #b42318;
    }

    .badge-approved {
        background: #d1fae5;
        color: #065f46;
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

    .modal-btn-cancel {
        background: #e5e7eb;
        color: #374151;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
    }

    .modal-btn-cancel:hover {
        background: #d1d5db;
    }

    .modal-btn-danger {
        background: #e53935;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        border: none;
    }

    .modal-btn-danger:hover {
        background: #c62828;
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
        <td>{{ $key + 1 }}</td>
        <td>{{ $worker->name }}</td>
        <td>{{ $worker->email }}</td>

        <td>
            {{-- STATUS ADMIN --}}
            @if($worker->is_verified_by_admin == 0)
                <span class="badge-status badge-wait">Belum Mengajukan</span>

            @elseif($worker->is_verified_by_admin == 3)
                <span class="badge-status badge-submitted">Menunggu Verifikasi Admin</span>

            @elseif($worker->is_verified_by_admin == 1)
                <span class="badge-status badge-approved">✔ Terverifikasi</span>

            @elseif($worker->is_verified_by_admin == 2)
                <span class="badge-status badge-rejected">❌ Ditolak</span>
            @endif
        </td>

        <td>
            <div class="table-actions">

                {{-- DETAIL --}}
                <a href="{{ route('admin.pekerja.show', $worker->id) }}" class="btn-view">Detail</a>

                {{-- APPROVE & REJECT --}}
                @if($worker->is_verified_by_admin == 3)

                    {{-- APPROVE BUTTON --}}
                    <form action="{{ route('admin.pekerja.update', $worker->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="approved">
                        <button class="btn-approve">Setujui</button>
                    </form>


                    {{-- REJECT BUTTON --}}
                    <button type="button"
                        class="btn-delete"
                        onclick="openRejectModal({{ $worker->id }})">
                        Tolak
                    </button>

                @elseif($worker->is_verified_by_admin == 0)
                    <span style="font-size:13px; color:#777;">❌ Belum Mengajukan</span>
                @endif

                {{-- DELETE USER --}}
                <form action="{{ route('admin.pekerja.destroy', $worker->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus pekerja ini?')" class="btn-delete">
                        Hapus
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="empty">Belum ada pekerja yang terdaftar</td>
    </tr>
@endforelse
        </tbody>
    </table>

</div>


<!-- MODAL PENOLAKAN -->
<div id="rejectModal" style="
    display:none;
    position: fixed; top:0; left:0; width:100%; height:100%;
    background: rgba(0,0,0,0.5); padding-top:120px;
">
    <div style="
        background:white; width:380px; margin:auto; padding:20px;
        border-radius:10px;
    ">
        <h5 class="fw-bold mb-3">Alasan Penolakan</h5>

        <form id="rejectForm" method="POST">
            @csrf
            <input type="hidden" name="status" value="rejected">

            <textarea name="verification_note" rows="4" class="form-control" required
                placeholder="Tuliskan alasan penolakan..."></textarea>

            <div class="mt-3 d-flex justify-content-end">
                <button type="button"
                    onclick="closeRejectModal()"
                    class="modal-btn-cancel me-2">
                    Batal
                </button>

                <button type="submit" class="modal-btn-danger">
                    Kirim Penolakan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(id) {
    document.getElementById('rejectModal').style.display = 'block';

    document.getElementById('rejectForm').action =
        '/admin/pekerja/' + id + '/update-status';
}

function closeRejectModal() {
    document.getElementById('rejectModal').style.display = 'none';
}
</script>

</x-layoutAdmin>
