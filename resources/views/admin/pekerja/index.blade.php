<x-layoutAdmin :title="$title">

<link rel="stylesheet" href="{{ asset('css/admin_pekerja.css') }}">

<div class="card p-4">

    <h4 class="mb-3">Manajemen Pekerja</h4>

    <table class="table-custom user-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($workers as $key => $worker)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $worker->name }}</td>
                    <td>{{ $worker->email }}</td>
                    <td>
                        <span class="badge-status {{ $worker->status }}">
                            {{ ucfirst($worker->status) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('pekerja.show', $worker->id) }}" class="btn-view">Detail</a>

                        <form action="{{ route('pekerja.delete', $worker->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus pekerja ini?')" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Belum ada pekerja</td></tr>
            @endforelse
        </tbody>
    </table>

</div>

</x-layoutAdmin>
