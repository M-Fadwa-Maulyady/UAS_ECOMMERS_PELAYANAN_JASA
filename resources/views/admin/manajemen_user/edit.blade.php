<x-layoutAdmin :title="$title">

<div class="card shadow p-4">

    <h3 class="fw-semibold mb-3">Edit User</h3>

    <form action="{{ route('admin.manajemen-user.update', $user->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div>
            <label class="form-label">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>

        <div>
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="form-actions">
            <a href="{{ route('admin.manajemen-user.index') }}" class="btn-back">⬅ Kembali</a>
            <button class="btn-update">🔧 Update</button>
        </div>

    </form>
</div>

</x-layoutAdmin>
