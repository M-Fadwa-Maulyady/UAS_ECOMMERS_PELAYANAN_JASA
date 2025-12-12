<x-layoutUser title="Pesanan Saya">

<style>
    .order-container {
        max-width: 1100px;
        margin: 40px auto;
        background: white;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    thead {
        background: #0E6B50;
        color: white;
    }

    thead th {
        padding: 14px;
        text-align: center;
        font-weight: bold;
        font-size: 13px;
        text-transform: uppercase;
    }

    tbody tr {
        background: #ffffff;
        border-radius: 12px;
        transition: .25s;
    }

    tbody tr:hover {
        background: #E7FFF2;
        transform: scale(1.01);
    }

    td {
        padding: 14px;
        text-align: center;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
    }

    .badge-wait { background: #ffda79; }
    .badge-done { background: #2ecc71; color: white; }
    .badge-pending { background: #ff6b6b; color: white; }
    .badge-worker { background: #1abc9c; color:white; }

    .btn {
        border: none;
        padding: 7px 14px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: .2s;
        color:white;
        display:inline-block;
    }

    .btn-pay { background:#007bff; }
    .btn-upload { background:#2980b9; }
    .btn-confirm { background:#0E6B50; }
    .btn-revision { background:#d9534f; }

    .btn:hover { opacity: .8; }

    img.bukti-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #ccc;
    }

</style>

<div class="order-container">

    <h3 class="fw-bold mb-3">📦 Pesanan Saya</h3>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Jasa</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
        </thead>

        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td class="fw-semibold text-success">
                    {{ $order->jasa->nama_jasa }}
                </td>

                <td>{{ \Carbon\Carbon::parse($order->tanggal)->format('d M Y') }}</td>


                {{-- STATUS --}}
                <td>
                    @switch($order->status)

                        @case('waiting_payment')
                            <span class="badge badge-wait">Menunggu Pembayaran 💳</span>
                        @break

                        @case('waiting_upload')
                            <span class="badge badge-worker">Upload Bukti 📤</span>
                        @break

                        @case('waiting_verification')
                            <span class="badge badge-pending">Menunggu Verifikasi Admin ⏳</span>
                        @break

                        @case('waiting_user_confirmation')
                            <span class="badge badge-wait">Menunggu Konfirmasi</span>
                        @break

                        @case('revision_requested')
                            <span class="badge badge-worker">Revisi Diminta ⚠</span>
                        @break

                        @case('finished')
                            <span class="badge badge-done">Selesai ✔</span>
                        @break

                        @default
                            <span class="badge badge-pending">{{ $order->status }}</span>

                    @endswitch
                </td>


                {{-- FOTO BUKTI --}}
                <td>
                    @if($order->bukti_pengerjaan)
                        <img src="{{ asset('storage/bukti_order/' . $order->bukti_pengerjaan) }}" class="bukti-img">
                    @else
                        <span>-</span>
                    @endif
                </td>


                {{-- ACTION BUTTONS --}}
                {{-- ACTION BUTTONS --}}
<td>

    {{-- BAYAR --}}
    @if($order->status === 'waiting_payment')
        <a href="{{ route('payment.page', $order->id) }}" class="btn btn-pay">💳 Bayar Sekarang</a>

    {{-- UPLOAD BUKTI PEMBAYARAN --}}
    @elseif($order->status === 'waiting_upload')
        <a href="{{ route('payment.upload.form', $order->id) }}" class="btn btn-upload">📤 Upload Bukti</a>

    {{-- MENUNGGU VERIFIKASI --}}
    @elseif($order->status === 'waiting_verification')
        <span style="opacity:0.8;">⏳ Sedang Diverifikasi Admin...</span>

    {{-- KONFIRMASI & REVISI setelah pekerja mengirim bukti pekerjaan --}}
    @elseif($order->status === 'waiting_user_confirmation')

        <form method="POST" action="{{ route('user.order.confirm', $order->id) }}" style="display:inline-block;">
            @csrf
            <button class="btn btn-confirm">✔ Konfirmasi</button>
        </form>

        <form method="POST" action="{{ route('user.order.reject', $order->id) }}" 
              style="display:inline-block; margin-left:6px;">
            @csrf
            <button class="btn btn-revision">✘ Revisi</button>
        </form>

    {{-- SELESAI --}}
    @elseif($order->status === 'finished')
        <span class="text-success fw-bold">✔ Selesai</span>

    {{-- REVISI DIMINTA --}}
    @elseif($order->status === 'revision_requested')
        <span style="opacity:0.7; font-style:italic;">Menunggu Perbaikan...</span>

    {{-- DEFAULT --}}
    @else
        <span style="opacity:0.4;">-</span>
    @endif
</td>


            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</x-layoutUser>
