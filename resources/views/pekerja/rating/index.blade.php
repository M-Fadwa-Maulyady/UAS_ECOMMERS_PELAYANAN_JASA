<x-layoutJasa title="Rating & Review">

<div class="table-box">

    <h4 class="fw-bold mb-3">⭐ Rating dari Pelanggan</h4>

    @if($ratings->count())
        <table class="table align-middle text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Jasa</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ratings as $rating)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rating->user->name }}</td>
                    <td>{{ $rating->order->jasa->nama_jasa }}</td>
                    <td>
                        @for($i=1; $i<=5; $i++)
                            <i class="fa-star {{ $i <= $rating->rating ? 'fa-solid text-warning' : 'fa-regular text-muted' }}"></i>
                        @endfor
                    </td>
                    <td>{{ $rating->review ?? '-' }}</td>
                    <td>{{ $rating->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-muted text-center py-4">
            Belum ada rating dari pelanggan.
        </div>
    @endif

</div>

</x-layoutJasa>
