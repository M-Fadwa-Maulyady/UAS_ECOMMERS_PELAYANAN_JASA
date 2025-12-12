<x-layoutUser title="Pesanan Saya">

<style>
.badge-waiting { background:#ffc107; color:#000; padding:6px 10px; border-radius:8px; font-weight:600; }
.badge-process { background:#17a2b8; color:white; padding:6px 10px; border-radius:8px; font-weight:600; }
.badge-done { background:#28a745; color:white; padding:6px 10px; border-radius:8px; font-weight:600; }

.btn-confirm {
    background:#0E6B50;
    color:white;
    padding:8px 14px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
.btn-confirm:hover { background:#094c38; }
</style>

<div class="card shadow p-4" style="border-radius:18px;">

    <h3 class="fw-bold mb-4">📦 Pesanan Saya</h3>

    <table class="table align-middle">

        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Jasa</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Chat</th>  {{-- FIX: Kolom Chat --}}
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td class="fw-semibold">{{ $order->jasa->nama_jasa }}</td>

                <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>

                <td>
                    @if($order->status === 'waiting_user_confirmation')
                        <span class="badge-waiting">Menunggu Konfirmasi</span>
                    @elseif($order->status === 'finished')
                        <span class="badge-done">Selesai</span>
                    @else
                        <span class="badge-process">{{ ucfirst($order->status) }}</span>
                    @endif
                </td>

                <td>
                    @if($order->bukti_pengerjaan)
                        <img src="{{ asset('storage/bukti/'.$order->bukti_pengerjaan) }}"
                        width="60" height="60"
                        style="object-fit:cover; border-radius:10px;">
                    @else
                        -
                    @endif
                </td>

                {{-- FIX: Tombol chat muncul di kolom CHAT --}}
                <td>
                    <a href="{{ route('order.chat', $order->id) }}" 
                       class="btn btn-sm btn-info">
                        💬 Chat
                    </a>
                </td>

                <td>
                    @if($order->status === 'waiting_user_confirmation')
                        <a class="btn-confirm"
                           href="{{ route('user.order.confirm', $order->id) }}">
                            ✔ Konfirmasi
                        </a>
                    @else
                        -
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

</x-layoutUser>
