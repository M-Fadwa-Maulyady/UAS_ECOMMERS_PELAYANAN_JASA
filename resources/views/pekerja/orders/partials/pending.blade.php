@if($pendingOrders->count())
<table class="table text-center align-middle">
<thead>
<tr>
    <th>No</th><th>Customer</th><th>Jasa</th><th>Alamat</th><th>Tanggal</th><th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($pendingOrders as $order)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $order->user->name }}</td>
<td>{{ $order->jasa->nama_jasa }}</td>
<td>{{ $order->alamat }}</td>
<td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>
<td>
    <form action="{{ route('pekerja.orders.accept', $order->id) }}" method="POST" class="d-inline">@csrf
        <button class="btn btn-success btn-sm">✔ Terima</button>
    </form>
    <form action="{{ route('pekerja.orders.reject', $order->id) }}" method="POST" class="d-inline">@csrf
        <button class="btn btn-danger btn-sm">✖ Tolak</button>
    </form>
</td>
</tr>
@endforeach
</tbody>
</table>
@else
<div class="text-muted text-center py-3">Tidak ada pesanan.</div>
@endif
