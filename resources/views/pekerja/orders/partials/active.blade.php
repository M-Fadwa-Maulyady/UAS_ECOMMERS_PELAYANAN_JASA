<div class="table-container">

    @if($activeOrders->count())
        <table class="table align-middle text-center mb-0">
            <thead class="table-warning">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Jasa</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Selesaikan</th>
                </tr>
            </thead>
            <tbody>
            @foreach($activeOrders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td class="fw-semibold text-primary">{{ $order->jasa->nama_jasa }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>
                    <td><span class="badge bg-warning text-dark">Diproses</span></td>
                    <td>
                        <form action="{{ route('pekerja.orders.finish', $order->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">
                                ✔ Selesai
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="text-muted py-4 text-center">
            🛠 Belum ada pesanan yang sedang dikerjakan.
        </div>
    @endif

</div>
