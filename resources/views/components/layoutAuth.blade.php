<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Gerak Cepat - Auth' }}</title>

    {{-- AUTO LOAD CSS LOGIN / REGISTER --}}
    @if(isset($page) && $page === 'register')
        <link rel="stylesheet" href="{{ asset('ayam/register.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('ayam/login.css') }}">
    @endif

    
</head>

<body>

    <div class="auth-container">
        {{ $slot }}
    </div>

    {{-- JS --}}
    <script src="{{ asset('ayam/login.js') }}"></script>
    <script src="{{ asset('ayam/register.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- TOAST --}}
    @if (session('success') || session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-end",
                iconColor: "white",
                customClass: { popup: "colored-toast" },
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: "{{ session('success') ? 'success' : 'error' }}",
                title: "{{ session('success') ?? session('error') }}",
            });
        </script>
    @endif

</body>
</html>
