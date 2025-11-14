@php
    use Illuminate\Support\Facades\Auth;
@endphp

@if(Auth::check())

    @php
        $role = strtolower(Auth::user()->role);
    @endphp

    @if ($role === 'admin')
        {{-- Sidebar Admin --}}
        <x-sidebar-admin />

    @elseif ($role === 'jasa')
        {{-- Sidebar Jasa --}}
        <x-sidebar-jasa />

    @else
        {{-- USER tidak pakai sidebar — KOSONG --}}
    @endif

@endif
