<x-layoutJasa title="Dashboard">

<style>
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 18px;
    margin-bottom: 28px;
}
.kpi-card {
    background: white;
    border-radius: 16px;
    padding: 18px;
    box-shadow: 0 6px 20px rgba(0,0,0,.06);
}
.kpi-title {
    font-size: 13px;
    color: #6c757d;
}
.kpi-value {
    font-size: 22px;
    font-weight: 700;
    color: #0E6B50;
}
.table-card {
    background: white;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 6px 20px rgba(0,0,0,.06);
}
</style>

<h3 class="mb-3">👋 Halo, {{ auth()->user()->name }}</h3>

{{-- KPI --}}
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-title">Order Baru</div>
        <div class="kpi-value">{{ $orderBaru }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Order Aktif</div>
        <div class="kpi-value">{{ $orderAktif }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Order Selesai</div>
        <div class="kpi-value">{{ $orderSelesai }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Saldo</div>
        <div class="kpi-value">Rp {{ number_format($saldo,0,',','.') }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Rating</div>
        <div class="kpi-value">⭐ {{ number_format($rating ?? 0,1) }}</div>
    </div>
</div>

{{-- ORDER TERBARU --}}
<div class="table-card">
    <h5 class="mb-3">📦 Order Terbaru</h5>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>Jasa</th>
                <th>Klien</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->jasa->nama_jasa }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                    <span class="badge bg-success">
                        {{ str_replace('_',' ', $order->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('pekerja.orders.index') }}" class="btn btn-sm btn-outline-success">
                        Lihat
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    Belum ada order
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

</x-layoutJasa>
