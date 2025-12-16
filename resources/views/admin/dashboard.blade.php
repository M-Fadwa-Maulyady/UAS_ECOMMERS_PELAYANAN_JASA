<x-layoutAdmin title="Dashboard Admin">

<style>
.dashboard-kpi {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 18px;
    margin-bottom: 28px;
}

.kpi-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 18px;
    box-shadow: 0 6px 18px rgba(0,0,0,.06);
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

.section-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px;
    box-shadow: 0 6px 18px rgba(0,0,0,.06);
    margin-bottom: 26px;
}
</style>

<h3 class="mb-3">📊 Dashboard Admin</h3>
<p class="text-muted mb-4">Ringkasan aktivitas sistem</p>

{{-- KPI --}}
<div class="dashboard-kpi">
    <div class="kpi-card">
        <div class="kpi-title">Total User</div>
        <div class="kpi-value">{{ $totalUser }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Total Pekerja</div>
        <div class="kpi-value">{{ $totalPekerja }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Total Jasa</div>
        <div class="kpi-value">{{ $totalJasa }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Order Masuk</div>
        <div class="kpi-value">{{ $orderMasuk }}</div>
    </div>

    <div class="kpi-card">
        <div class="kpi-title">Total Transaksi</div>
        <div class="kpi-value">
            Rp {{ number_format($totalTransaksi,0,',','.') }}
        </div>
    </div>
</div>

{{-- ORDER TERBARU --}}
<div class="section-card">
    <h5 class="mb-3">📦 Order Terbaru</h5>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>User</th>
                <th>Jasa</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->jasa->nama_jasa }}</td>
                <td>
                    <span class="badge bg-warning">
                        {{ str_replace('_',' ', $order->status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
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

{{-- RATING --}}
<div class="section-card">
    <h5 class="mb-2">⭐ Rating Sistem</h5>
    <p class="mb-0">
        Rata-rata rating pekerja:
        <strong>{{ number_format($ratingAvg ?? 0,1) }}</strong>
    </p>
</div>

</x-layoutAdmin>
