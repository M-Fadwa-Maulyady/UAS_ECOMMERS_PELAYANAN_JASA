{{-- Sedang Dikerjakan --}}
<div class="table-box">
    <h5 class="fw-bold mb-3">🔧 Sedang Dikerjakan</h5>

    @if($activeOrders->count())
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
        @foreach($activeOrders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->user->name }}</td>
            <td class="fw-semibold text-primary">{{ $order->jasa->nama_jasa }}</td>
            <td>{{ $order->alamat }}</td>
            <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>
            <td><span class="badge-status">Accepted Worker</span></td>
            <td>-</td>
            <td>
                <button class="btn btn-success btn-sm"
                        data-bs-toggle="collapse"
                        data-bs-target="#upload-{{ $order->id }}">
                    📤 Upload & Selesai
                </button>
            </td>
        </tr>

        {{-- COLLAPSE AREA (NOW WITH SPACE) --}}
        <tr class="spacing-row">
            <td colspan="8">
                <div id="upload-{{ $order->id }}" class="collapse upload-area">

                    <h6>📁 Upload Bukti Pekerjaan</h6>

                    <form action="{{ route('pekerja.orders.finish', $order->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="file" name="bukti_pengerjaan"
                               class="form-control" required accept="image/*">

                        <div class="upload-buttons">
                            <button type="submit" class="btn btn-success">
                                ✔ Kirim & Selesaikan
                            </button>
                            <button data-bs-toggle="collapse"
                                    data-bs-target="#upload-{{ $order->id }}"
                                    type="button" class="btn btn-outline-danger">
                                ✖ Batal
                            </button>
                        </div>

                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p class="text-muted text-center py-3">Tidak ada pesanan berjalan.</p>
    @endif
</div>
