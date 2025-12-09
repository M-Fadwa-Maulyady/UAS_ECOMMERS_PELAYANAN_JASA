<div class="table-container">

    @if($historyOrders->count())
        <table class="table align-middle text-center mb-0">
            <thead class="table-secondary">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Jasa</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach($historyOrders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->jasa->nama_jasa }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>
                    <td>
                        @if($order->status === 'finished')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="text-muted py-4 text-center">
            📁 Belum ada riwayat pesanan.
        </div>
    @endif

</div>
