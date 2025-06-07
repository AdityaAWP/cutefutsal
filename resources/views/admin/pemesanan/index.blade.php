
<div class="py-10 px-4 md:px-20 bg-gray-100 min-h-screen">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Data Pemesanan Lapangan</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-white uppercase bg-[#FFB3C6]">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">No HP</th>
                    <th class="px-6 py-3">Tanggal Main</th>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3">Lapangan</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanans as $pemesanan)
                <tr class="border-b hover:bg-pink-50">
                    <td class="px-6 py-4">{{ $pemesanan->nama }}</td>
                    <td class="px-6 py-4">{{ $pemesanan->no_hp }}</td>
                    <td class="px-6 py-4">{{ $pemesanan->tgl_main }}</td>
                    <td class="px-6 py-4">{{ $pemesanan->waktu_main }}</td>
                    <td class="px-6 py-4">{{ $pemesanan->lapangan->nama_lapangan ?? '-' }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('pemesanan.edit', $pemesanan->id) }}"
                            class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">Edit</a>
                        
                        <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
