<x-layoutJasa title="Order Management">

@foreach ([
    'pending' => ['title' => 'Menunggu Persetujuan', 'data' => $pendingOrders],
    'active'  => ['title' => 'Sedang Dikerjakan', 'data' => $activeOrders],
    'history' => ['title' => 'Riwayat Pesanan', 'data' => $historyOrders],
] as $section)

<div class="table-box">

    <h5 class="fw-bold mb-3">📌 {{ $section['title'] }}</h5>

    @if($section['data']->count())
        <table class="table align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Jasa</th>
                    <th>Alamat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($section['data'] as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td class="fw-semibold text-primary">{{ $order->jasa->nama_jasa }}</td>
                    <td>{{ $order->alamat }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>
                    <td>
                        <span class="badge-status">
                            {{ ucfirst(str_replace('_',' ',$order->status)) }}
                        </span>
                    </td>

                    {{-- Bukti --}}
                    <td>
                        @if($order->bukti_pengerjaan)
                            <img src="{{ asset('uploads/bukti/'.$order->bukti_pengerjaan) }}"
                                 class="bukti-preview">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td>
                    @if($order->status === 'waiting_worker')
                        <form method="POST" action="{{ route('pekerja.orders.accept', $order->id) }}">
                            @csrf
                            <button class="btn-green btn-sm w-100 mb-1">
                                ✔ Terima
                            </button>
                        </form>

                        <form method="POST" action="{{ route('pekerja.orders.reject', $order->id) }}">
                            @csrf
                            <button class="btn-red btn-sm w-100">
                                ✖ Tolak
                            </button>
                        </form>

                    @elseif($order->status === 'waiting_payment')
                        <span class="text-muted">Sedang dikerjakan</span>

                    @elseif($order->status === 'finished')
                        <span class="text-success">✔ Selesai</span>

                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-muted text-center py-3">
            🚫 Tidak ada data.
        </div>
    @endif

</div>
@endforeach

</x-layoutJasa>
