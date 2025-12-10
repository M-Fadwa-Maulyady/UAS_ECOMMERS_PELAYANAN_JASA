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

                    {{-- Jika sudah ada bukti --}}
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
                        @if($section['title'] === 'Menunggu Persetujuan')
                            <form method="POST" action="{{ route('pekerja.orders.accept',$order->id) }}">
                                @csrf
                                <button class="btn-green btn-sm">✔ Terima</button>
                            </form>

                            <form method="POST" action="{{ route('pekerja.orders.reject',$order->id) }}" class="mt-1">
                                @csrf
                                <button class="btn-red btn-sm">✖ Tolak</button>
                            </form>

                        @elseif($section['title'] === 'Sedang Dikerjakan')

                            {{-- BUTTON MODAL UPLOAD --}}
                            <button class="btn-green btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalUpload-{{ $order->id }}">
                                📤 Upload & Selesai
                            </button>

                            {{-- MODAL --}}
                            <div class="modal fade" id="modalUpload-{{ $order->id }}">
                              <div class="modal-dialog modal-dialog-centered">
                                <form method="POST" enctype="multipart/form-data"
                                      action="{{ route('pekerja.orders.finish',$order->id) }}">
                                  @csrf
                                  <div class="modal-content p-3">
                                    <h5 class="fw-bold">Upload Bukti Pekerjaan</h5>
                                    <input required type="file" name="bukti_pengerjaan"
                                           class="form-control mt-2" accept="image/*">
                                    <button class="btn-green w-100 mt-3">✔ Kirim & Selesaikan</button>
                                  </div>
                                </form>
                              </div>
                            </div>

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
