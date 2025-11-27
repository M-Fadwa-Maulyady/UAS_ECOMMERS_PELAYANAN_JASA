<x-layoutJasa>

    <div class="container mx-auto mt-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Data Jasa</h2>

            <a href="{{ route('pekerja.manajemen-jasa.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow flex items-center gap-2 transition">
                <i class="fas fa-plus"></i>
                Tambah Jasa
            </a>
        </div>

        {{-- Flash Success --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Card Container --}}
        <div class="bg-white shadow-md rounded-lg overflow-hidden border">

            {{-- Card Header --}}
           

           
            {{-- Table --}}
<div class="table-wrapper">
    <table class="jasa-table">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Jasa</th>
                <th>Deskripsi</th>
                <th>Estimasi</th>
                <th>Harga</th>
                <th>Revisi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($jasa as $j)
                <tr>
                    <td>
                        @if ($j->gambar)
                            <img src="{{ asset('storage/' . $j->gambar) }}" alt="">
                        @else
                            <div class="noimg">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>

                    <td class="nama">{{ $j->nama_jasa }}</td>

                    <td class="deskripsi">
                        {{ Str::limit($j->deskripsi, 120) }}
                    </td>

                    <td>{{ $j->estimasi_waktu }} hari</td>

                    <td class="harga">
                        Rp {{ number_format($j->harga, 0, ',', '.') }}
                    </td>

                    <td>{{ $j->jumlah_revisi }}x</td>

                    <td>
                        <div class="aksi">
                            <a href="{{ route('pekerja.manajemen-jasa.edit', $j->id) }}" class="edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('pekerja.manajemen-jasa.delete', $j->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin mau hapus jasa ini?')">
                                @csrf
                                @method('DELETE')

                                <button class="hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="kosong">Belum ada data jasa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>



        </div>

    </div>

</x-layoutJasa>
