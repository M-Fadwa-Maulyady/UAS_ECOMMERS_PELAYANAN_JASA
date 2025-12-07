<x-layoutAdmin :title="'Manajemen Jasa'">

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
}
.table-custom tbody tr {
    background: #f8faf9;
}
.table-custom td {
    padding: 14px;
}
.badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 13px;
}
.badge-wait { background:#fff3cd; color:#946200; }
.badge-approved { background:#d1fae5; color:#065f46; }
.badge-rejected { background:#fde2e1; color:#b42318; }
.btn-sm {
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}
.btn-approve { background:#22c55e; color:white; }
.btn-reject { background:#ef4444; color:white; }
.btn-view { background:#3b82f6; color:white; }
</style>

<div class="card p-4">
    <h4 class="fw-bold mb-3">Manajemen Jasa</h4>

    <table class="table-custom">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jasa</th>
                <th>Pekerja</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
@foreach($jasaList as $i => $j)
<tr>
    <td>{{ $i + 1 }}</td>
    <td>{{ $j->nama_jasa }}</td>
    <td>{{ $j->user->name }}</td>

    <td>
        @if($j->status == 0)
            <span class="badge badge-wait">Menunggu Admin</span>
        @elseif($j->status == 1)
            <span class="badge badge-approved">✔ Disetujui</span>
        @else
            <span class="badge badge-rejected">Ditolak</span>
        @endif
    </td>

    <td>
        <div style="display:flex; gap:8px;">

            {{-- DETAIL --}}
            <a href="{{ route('admin.jasa.detail', $j->id) }}" class="btn-sm btn-view">Detail</a>

            {{-- APPROVE --}}
            @if($j->status == 0)
            <form action="{{ route('admin.jasa.approve', $j->id) }}" method="POST">
                @csrf
                <button class="btn-sm btn-approve">Setujui</button>
            </form>

            {{-- TOLAK --}}
            <button 
                onclick="openRejectModal({{ $j->id }})"
                class="btn-sm btn-reject">
                Tolak
            </button>
            @endif

        </div>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>

{{-- MODAL TOLAK --}}
<div id="modalReject" style="
    display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5);
    padding-top:120px; z-index:50;
">
    <div style="background:white; width:420px; margin:auto; padding:20px;
        border-radius:12px;">
        
        <h5 class="fw-bold mb-3">Alasan Penolakan</h5>

        <form id="formReject" method="POST">
            @csrf
            <textarea name="alasan" rows="4" class="form-control" required
                placeholder="Tuliskan alasan penolakan..."></textarea>

            <div class="mt-3 d-flex justify-content-end">
                <button type="button" 
                    onclick="closeRejectModal()" 
                    class="btn btn-secondary me-2">
                    Batal
                </button>

                <button class="btn btn-danger">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(id){
    document.getElementById('modalReject').style.display = 'block';
    document.getElementById('formReject').action =
        "/admin/jasa/" + id + "/reject";
}

function closeRejectModal(){
    document.getElementById('modalReject').style.display = 'none';
}
</script>

</x-layoutAdmin>
