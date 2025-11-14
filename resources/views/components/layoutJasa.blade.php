<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jasa | {{ $title ?? 'Gerak Cepat' }}</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('ayam/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('ayam/all.min.css') }}">

    <style>
        .colored-toast.swal2-icon-success { background-color: #52c41a !important; }
        .colored-toast.swal2-icon-error { background-color: #ff4d4f !important; }
        .colored-toast .swal2-title,
        .colored-toast .swal2-html-container { color: white; }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <x-navbar />

    {{-- Sidebar Jasa --}}
    <x-sidebar type="jasa" />

    {{-- CONTENT --}}
    <main class="content-wrapper">
        {{ $slot }}
    </main>

    {{-- JS --}}
    <script src="{{ asset('ayam/admin.js') }}"></script>
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
