<x-layoutJasa title="Order Management">

<style>
/* Wrapper style */
.orders-wrapper {
    max-width: 1250px;
    margin: 25px auto;
}

/* Tab Styling */
.nav-tabs {
    border-bottom: none !important;
}

.nav-tabs .nav-link {
    background: #f6f6f6;
    border-radius: 10px;
    margin-right: 10px;
    font-weight: 600;
    padding: 10px 22px;
    transition: .2s;
    border: 1px solid #ddd;
    color: #444;
}

.nav-tabs .nav-link:hover {
    background: #1b9c85;
    color: white;
}

.nav-tabs .nav-link.active {
    background: #009966;
    border-color: #009966;
    color: white !important;
}

/* Table Box */
.table-box {
    background: white;
    padding: 22px;
    border-radius: 15px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    margin-top: 15px;
}

/* Table style */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

thead tr {
    background: #e5f7ed;
    font-size: 14px;
    text-transform: uppercase;
    font-weight: bold;
}

tbody tr {
    background: #fff;
    border-radius: 10px;
}

tbody tr:hover {
    background: #f8fdfb;
}

td, th {
    padding: 14px !important;
}

/* Empty message */
.empty-state {
    padding: 35px;
    text-align: center;
    color: #777;
    font-size: 15px;
}

/* Buttons */
.btn-action {
    padding: 7px 18px;
    font-weight: 600;
    border-radius: 8px;
    font-size: 14px;
}
</style>

<div class="orders-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">📦 Order Management</h4>
        <button onclick="location.reload()" class="btn btn-outline-success btn-sm">🔄 Refresh</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Navigation Tabs --}}
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending">⏳ Menunggu</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#active">🔧 Sedang Dikerjakan</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#history">📁 Riwayat</button>
        </li>
    </ul>

    {{-- Tab Contents --}}
    <div class="tab-content">
        <div class="tab-pane fade show active" id="pending">
            @include('pekerja.orders.partials.pending')
        </div>
        <div class="tab-pane fade" id="active">
            @include('pekerja.orders.partials.active')
        </div>
        <div class="tab-pane fade" id="history">
            @include('pekerja.orders.partials.history')
        </div>
    </div>

</div>

</x-layoutJasa>
