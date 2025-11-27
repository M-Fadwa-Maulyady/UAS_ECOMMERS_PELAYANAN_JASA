<x-layoutAuth>
<div class="card">
    <div class="card-left">
      <h1>Register</h1>
      <p class="muted">Create your account to get started</p>

      <form method="POST" action="{{ route('register.post') }}" class="form">
        @csrf

        <input name="name" type="text" placeholder="Nama Lengkap" required />
        <input name="email" type="email" placeholder="Email" required />

        <input id="regPassword" name="password" type="password" placeholder="Password" required />
        <input name="password_confirmation" type="password" placeholder="Konfirmasi Password" required />

        <label class="label-inline">Register as</label>
        <select id="roleSelect" name="role" required>
          <option value="user">User</option>
          <option value="pekerja">Pekerja</option>
        </select>

        <div id="jasaFields" class="jasa-fields" style="display:none;">
          <input name="nama_usaha" type="text" placeholder="Nama Usaha" />
          <input name="kategori_jasa" type="text" placeholder="Kategori Jasa" />
          <textarea name="deskripsi_jasa" rows="3" placeholder="Deskripsi singkat jasa"></textarea>
        </div>

        <button type="submit" class="btn primary">Register</button>

        <p class="muted small">Sudah punya akun? 
           <a href="{{ route('login') }}">Login</a>
        </p>
      </form>
    </div>

    <div class="card-right">
      <img src="{{ asset('ayam/gambar-login.png') }}" alt="illustration" />
    </div>
</div>
</x-layoutAuth>
