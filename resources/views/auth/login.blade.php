<x-layoutAuth>

    <div class="card">
        {{-- LEFT SIDE --}}
        <div class="card-left">
            <h1>Login</h1>
            <p class="muted">If you are already a member, easily log in</p>

            {{-- ERROR MESSAGE --}}
            @if ($errors->any())
                <div style="color:red; margin-bottom:10px;">
                    @foreach ($errors->all() as $err)
                        • {{ $err }} <br>
                    @endforeach
                </div>
            @endif

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div style="color:green; margin-bottom:10px;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- LOGIN FORM --}}
            <form class="form" method="POST" action="{{ route('login.post') }}">
                @csrf

                <input 
                    name="email" 
                    type="email" 
                    placeholder="Email" 
                    value="{{ old('email') }}" 
                    required
                />

                <div class="pwd-row">
                    <input 
                        id="loginPassword" 
                        name="password" 
                        type="password" 
                        placeholder="Password" 
                        required
                    />

                    <button 
                        type="button" 
                        class="icon-btn" 
                        onclick="togglePassword('loginPassword')"
                    >
                        👁
                    </button>
                </div>

                <button type="submit" class="btn primary">Login</button>

                <div class="or">OR</div>

                <button type="button" class="btn outline">Login with Google</button>

                <a class="link small" href="#">Forgot my password</a>

                <p class="muted small">
                    If you don't have an account, 
                    <a href="{{ route('register') }}">Register</a>
                </p>
            </form>
        </div>

        {{-- RIGHT IMAGE --}}
        <div class="card-right">
            <img src="{{ asset('ayam/gambar-login.png') }}" alt="illustration">
        </div>
    </div>

</x-layoutAuth>
