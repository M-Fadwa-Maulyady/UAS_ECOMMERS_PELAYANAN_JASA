<x-layoutAdmin :title="$title">

<div class="card shadow p-4">

    <h3 class="fw-semibold mb-3">Tambah User</h3>

    <form action="{{ route('admin.manajemen-user.store') }}" method="POST" class="form-card">
        @csrf

        <div>
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div>
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div>
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.manajemen-user.index') }}" class="btn-back">⬅ Kembali</a>
            <button class="btn-submit">💾 Simpan</button>
        </div>
    </form>

</div>

</x-layoutAdmin>
