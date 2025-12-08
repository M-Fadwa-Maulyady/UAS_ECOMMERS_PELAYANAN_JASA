<div class="table-box">

@if($pendingOrders->count())

<table class="table align-middle text-center mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Jasa</th>
            <th>Alamat</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    
    <tbody>
        @foreach($pendingOrders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->user->name }}</td>
            <td class="fw-semibold text-success">{{ $order->jasa->nama_jasa }}</td>
            <td>{{ $order->alamat }}</td>
            <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>
            <td>
                <div class="d-flex justify-content-center gap-2">
                    <form method="POST" action="{{ route('pekerja.orders.accept', $order->id) }}">
                        @csrf
                        <button class="btn btn-success btn-action">✔ Terima</button>
                    </form>
                    <form method="POST" action="{{ route('pekerja.orders.reject', $order->id) }}">
                        @csrf
                        <button class="btn btn-danger btn-action">✖ Tolak</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@else
<div class="empty-state">🚫 Tidak ada pesanan menunggu.</div>
@endif

</div>
