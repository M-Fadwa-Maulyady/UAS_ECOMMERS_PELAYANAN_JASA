<x-layoutJasa title="Saldo Pekerja">

<style>
    .saldo-card {
        background: #0E6B50;
        color: white;
        border-radius: 14px;
        padding: 25px;
        text-align: center;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }

    .saldo-amount {
        font-size: 32px;
        font-weight: 700;
    }

    .withdraw-card {
        border: 1px solid #dceee5;
        background: #ffffff;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
        margin-bottom: 30px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table-custom th {
        background: #0E6B50;
        color: white;
        padding: 10px;
        text-align: center;
    }

    .table-custom td {
        padding: 10px;
        border-bottom: 1px solid #eee;
        text-align: center;
    }

    .badge-pending {
        background: #ffc107;
        color: #000;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 13px;
    }

    .badge-approved {
        background: #28a745;
        color: white;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 13px;
    }

    .badge-rejected {
        background: #dc3545;
        color: white;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 13px;
    }
    .withdraw-section {
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #e5e5e5;
    margin-top: 25px;
}

.withdraw-title {
    font-size: 18px;
    font-weight: 600;
    color: #0E6B50;
    margin-bottom: 15px;
}

.withdraw-form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: center;
}

.withdraw-form label {
    font-weight: 600;
}

.withdraw-form input,
.withdraw-form select {
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    min-width: 180px;
}

.withdraw-btn {
    background: #0E6B50;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
}

.withdraw-btn:hover {
    opacity: 0.85;
}
</style>


<div class="container mt-4">

    {{-- SALDO --}}
    <div class="saldo-card">
        <div>Saldo Tersedia</div>
        <div class="saldo-amount">Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</div>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="withdraw-section">
    <div class="withdraw-title">💸 Ajukan Penarikan Dana</div>

    <form action="{{ route('worker.saldo.withdraw') }}" method="POST" class="withdraw-form">
        @csrf

        <div>
            <label>Nominal Penarikan</label>
            <input type="number" name="amount" min="10000" placeholder="Min. 10.000" required>
        </div>

        <div>
            <label>Bank</label>
            <select name="bank_name" required>
                <option value="BCA">BCA</option>
                <option value="BRI">BRI</option>
                <option value="BNI">BNI</option>
                <option value="Mandiri">Mandiri</option>
                <option value="CIMB">CIMB</option>
            </select>
        </div>

        <div>
            <label>Nomor Rekening</label>
            <input type="text" name="rekening" placeholder="Masukkan nomor rekening" required>
        </div>

        <button class="withdraw-btn">Ajukan Penarikan</button>
    </form>
</div>


    {{-- RIWAYAT WITHDRAW --}}
    <h4 class="mt-4 mb-2" style="font-weight:600;">Riwayat Penarikan</h4>

    <table class="table-custom">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Bank</th>
                <th>Rekening</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($withdraws as $row)
                <tr>
                    <td>{{ $row->created_at->format('d M Y') }}</td>
                    <td>Rp {{ number_format($row->amount, 0, ',', '.') }}</td>
                    <td>{{ $row->bank_name }}</td>
                    <td>{{ $row->rekening }}</td>
                    <td>
                        @if($row->status == 'pending')
                            <span class="badge-pending">Menunggu</span>
                        @elseif($row->status == 'approved')
                            <span class="badge-approved">Disetujui</span>
                        @elseif($row->status == 'rejected')
                            <span class="badge-rejected">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada riwayat penarikan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</x-layoutJasa>
