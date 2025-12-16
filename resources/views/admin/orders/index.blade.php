<x-layoutAdmin title="Manajemen Order">

<style>
    /* TABLE STYLING */
    table {
        border-collapse: separate !important;
        border-spacing: 0 14px;
        width: 100%;
    }

    thead tr {
        background: #effff3;
        border-radius: 12px;
    }

    thead th {
        padding: 14px !important;
        font-weight: 600;
        font-size: 14px;
        text-align: center;
    }

    tbody tr {
        background: #fff;
        border-radius: 14px;
        transition: .25s;
    }

    tbody tr:hover {
        background: #e9ffe9;
        transform: scale(1.01);
    }

    td {
        padding: 18px 12px !important;
        font-size: 14px;
        vertical-align: middle;
        text-align: center;
    }

    /* BADGE STYLES */
    .badge-soft {
        padding: 8px 14px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: bold;
        display: inline-block;
        text-transform: capitalize;
    }

    /* BUTTON STYLING */
    .btn-action {
        border: none;
        padding: 8px 14px;
        border-radius: 10px;
        color: #fff;
        cursor: pointer;
        font-size: 14px;
        transition: .2s;
        min-width: 95px;
    }

    .btn-approve {
        background: #2ecc71;
    }
    .btn-approve:hover { background:#27ae60; }

    .btn-reject {
        background: #e74c3c;
    }
    .btn-reject:hover { background:#c0392b; }

    .action-wrapper {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

</style>


<div class="card shadow-sm p-4" style="border-radius:16px;">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold m-0">📦 Manajemen Order</h4>

        <button onclick="location.reload()" class="btn btn-outline-success btn-sm">
            🔄 Refresh
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Pemesan</th>
                <th>Jasa</th>
                <th>Pekerja</th>
                <th>Alamat</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $order->user->name }}</td>

                <td class="fw-semibold text-success">
                    {{ $order->jasa->nama_jasa }}
                </td>

                <td>{{ $order->worker->name }}</td>

                <td>{{ $order->alamat }}</td>

                <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>


                <td>
                    @switch($order->status)
                        @case('pending_admin')
                            <span class="badge-soft" style="background:#FFE38E;">Menunggu Admin</span>
                        @break

                        @case('approved_admin')
                            <span class="badge-soft" style="background:#28c76f; color:white;">Disetujui Admin</span>
                        @break

                        @case('rejected_admin')
                            <span class="badge-soft" style="background:#ff4f4f; color:white;">Ditolak Admin</span>
                        @break

                        @case('waiting_worker')
                            <span class="badge-soft" style="background:#64b5f6;">Menunggu Pekerja</span>
                        @break

                        @case('accepted_worker')
                            <span class="badge-soft" style="background:#2ecc71; color:white;">Diterima Pekerja</span>
                        @break

                        @case('rejected_worker')
                            <span class="badge-soft" style="background:#e53935; color:white;">Ditolak Pekerja</span>
                        @break
                    @endswitch
                </td>


                <td>
                    @if($order->status === 'pending_admin')
                        <div class="action-wrapper">

                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-action btn-approve">
                                    ✔ Approve
                                </button>
                            </form>

                            <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-action btn-reject">
                                    ✖ Reject
                                </button>
                            </form>

                        </div>
                    @else
                        <span style="opacity:.6; font-style:italic;">Sudah diproses</span>
                    @endif
                </td>
            </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        🚫 Belum ada pesanan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</x-layoutAdmin>
