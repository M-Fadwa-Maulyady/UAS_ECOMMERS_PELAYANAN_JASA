<x-layoutAdmin title="Manajemen Transaksi">

    <style>/* WARNA BADGE STATUS */
.badge {
    padding: 6px 12px;
    font-size: 13px;
    border-radius: 8px;
}

/* status paid */
.badge.bg-success,
.badge.bg-paid {
    background-color: #0E6B50 !important;
    color: white !important;
}

/* status waiting verification */
.badge.bg-info {
    background-color: #1E90FF !important;
    color: white !important;
}

/* Link "Lihat" */
.table a {
    color: #0E6B50;
    font-weight: 600;
    text-decoration: underline;
}

.table a:hover {
    color: #004c34;
}

/* Tombol aksi */
.btn-success {
    background-color: #0E6B50 !important;
    border-color: #0E6B50 !important;
    color: white !important;
}

.btn-warning {
    background-color: #FFC107 !important;
    border-color: #E0A800 !important;
    color: black !important;
}

.btn-sm {
    padding: 6px 10px !important;
    font-size: 13px !important;
    border-radius: 6px !important;
}
</style>

<div class="card p-4">

    <h3 class="mb-3">📑 Daftar Pembayaran</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Order</th>
                <th>Metode</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($payments as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->order->user->name }}</td>
                    <td>{{ $p->order->jasa->nama_jasa }}</td>
                    <td>{{ $p->method }} ({{ $p->bank_name }})</td>
                    <td>Rp {{ number_format($p->total) }}</td>

                    <td>
                        <span class="badge bg-info">{{ $p->status }}</span>
                    </td>

                    <td>
                        @if($p->bukti_transfer)
                            <a href="{{ asset('storage/payment_proof/'.$p->bukti_transfer) }}" target="_blank" class="btn btn-sm btn-primary">
                                Lihat
                            </a>
                        @else
                            <span class="text-danger">Belum upload</span>
                        @endif
                    </td>

                    <td>
                        @if($p->status === 'waiting_verification')
                            <form action="{{ route('admin.payments.approve', $p->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>
                        @elseif($p->status === 'paid')
                            <form action="{{ route('admin.payments.sendWorker', $p->id) }}" method="POST" class="mt-1">
                                @csrf
                                <button class="btn btn-warning btn-sm">Kirim ke Pekerja</button>
                            </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</x-layoutAdmin>
