<x-layoutAdmin :title="$title">

<div class="card shadow p-4">

    {{-- Header Top --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold m-0">Manajemen User</h3>

        <a href="{{ route('manajemen-user.create') }}" class="btn-add-user">
            + Tambah User
        </a>
    </div>

    {{-- TABLE --}}
    <div class="table-container">
        <div class="table-responsive">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="d-flex gap-2">

                            <a href="{{ route('manajemen-user.edit', $user->id) }}" class="btn-edit">
                                ✏ Edit
                            </a>

                            <form action="{{ route('manajemen-user.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus user ini?')" class="btn-delete">
                                    🗑 Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">
                            Belum ada user.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

</x-layoutAdmin>
