<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lapangan - Cute Futsal</title>
    @vite(['resources/css/app.css'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-white font-poppins">

    {{-- Navbar --}}
    <nav
        class="bg-gradient-to-r from-[#FAA4BD] to-[#F564A9] shadow-md w-full py-4 px-6 md:px-40 flex items-center justify-between text-white fixed top-0 left-0 z-50">
        <a href="#" class="flex items-center">
            <img src="{{ asset('LogoCute.png') }}" alt="Cute Futsal" class="h-12 md:h-16 rounded-lg ">
            <h1 class="text-lg font-bold pl-4">CUTE FUTSAL</h1>
        </a>
        <div class="hidden md:flex space-x-8 sm:flex max-sm:hidden items-center">
            <a href="{{ route('admin.lapangan.index') }}" class="font-semibold">Lapangan</a>
            <a href="{{ route('admin.welcome') }}">Pemesanan</a>
            <a href="/login"
                class="bg-white text-[#FF8FAB] px-5 py-2 rounded-full font-semibold shadow-sm hover:bg-white/90 transition duration-300">Logout</a>
        </div>
    </nav>

    <div class="mt-20 px-4 md:px-20 bg-gray-100 min-h-screen">
        <h2 class="text-3xl font-bold text-center text-pink-600 mb-8">Data Lapangan</h2>

        @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold text-center bg-green-100 py-3 px-4 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        {{-- Tombol Tambah Data --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.lapangan.create') }}"
                class="bg-green-400 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300 flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Lapangan
            </a>
        </div>

        <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-white uppercase bg-[#F564A9]">
                    <tr>
                        <th class="px-6 py-3">Gambar</th>
                        <th class="px-6 py-3">Nama Lapangan</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Spesifikasi</th>
                        <th class="px-6 py-3">Harga/Jam</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lapangans as $lapangan)
                    <tr class="border-b hover:bg-pink-50">
                        <td class="px-6 py-4">
                            @if($lapangan->gambar)
                            <img src="{{ asset('images/lapangan/' . $lapangan->gambar) }}"
                                alt="{{ $lapangan->nama_lapangan }}" class="w-16 h-16 object-cover rounded-lg">
                            @else
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold">{{ $lapangan->nama_lapangan }}</td>
                        <td class="px-6 py-4">{{ $lapangan->tipe }}</td>
                        <td class="px-6 py-4">
                            @if($lapangan->spesifikasi)
                            {{ Str::limit($lapangan->spesifikasi, 50) }}
                            @else
                            <span class="text-gray-400 italic">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-green-600">
                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                        </td>
                        <td class="px-6 pt-8 flex gap-2">
                            <a href="{{ route('admin.lapangan.edit', $lapangan->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs transition duration-300">
                                <i class="fas fa-edit"></i>
                                edit
                            </a>
                            <form action="{{ route('admin.lapangan.destroy', $lapangan->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus lapangan {{ $lapangan->nama_lapangan }}?')"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition duration-300">
                                    <i class="fas fa-trash"></i>
                                    hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl mb-4"></i>
                            <p class="text-lg">Belum ada data lapangan</p>
                            <a href="{{ route('admin.lapangan.create') }}"
                                class="inline-block mt-4 bg-green-400 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300">
                                Tambah Lapangan Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- FOOTER --}}
    @include('components.footer')

</body>

</html>