@if($historyOrders->count())
<table class="table text-center align-middle">
<thead>
<tr>
<th>No</th><th>Customer</th><th>Jasa</th><th>Tanggal</th><th>Status</th><th>Bukti</th>
</tr>
</thead>
<tbody>
@foreach($historyOrders as $order)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $order->user->name }}</td>
<td>{{ $order->jasa->nama_jasa }}</td>
<td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>
<td><span class="badge bg-success">Selesai</span></td>
<td><img src="{{ asset('uploads/bukti/'.$order->bukti_pengerjaan) }}"></td>
</tr>
@endforeach
</tbody>
</table>
@else
<div class="text-center text-muted py-3">Belum ada riwayat.</div>
@endif
