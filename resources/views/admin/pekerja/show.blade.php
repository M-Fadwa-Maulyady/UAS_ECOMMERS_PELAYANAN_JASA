<x-layoutAdmin :title="$title">

<link rel="stylesheet" href="{{ asset('css/admin_pekerja.css') }}">

<div class="card p-4 detail-container">

    <h4>Detail Pekerja</h4>
    <p><strong>Nama:</strong> {{ $worker->name }}</p>
    <p><strong>Email:</strong> {{ $worker->email }}</p>
    <p><strong>Status:</strong> 
        <span class="badge-status {{ $worker->status }}">{{ ucfirst($worker->status) }}</span>
    </p>

    <form action="{{ route('pekerja.updateStatus', $worker->id) }}" method="POST" class="mt-3">
        @csrf @method('PUT')

        <label>Status Pekerja</label>
        <select name="status" class="form-control">
            <option value="pending" {{ $worker->status=='pending'?'selected':'' }}>Pending</option>
            <option value="active" {{ $worker->status=='active'?'selected':'' }}>Active</option>
            <option value="suspended" {{ $worker->status=='suspended'?'selected':'' }}>Suspended</option>
        </select>

        <button class="btn-update mt-3">Update Status</button>
    </form>

    <a href="{{ route('pekerja.index') }}" class="btn-back mt-4">Kembali</a>

</div>

</x-layoutAdmin>
