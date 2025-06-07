<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cute Futsal</title>
    @vite(['resources/css/app.css'])

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-white font-poppins">

    {{-- Navbar --}}
    {{-- Navbar --}}
    <nav class="bg-gradient-to-r from-[#FFB3C6] to-[#FF8FAB] shadow-md w-full py-4 px-6 md:px-40 flex items-center justify-between text-white fixed top-0 left-0 z-50">
  <a href="#" class="flex items-center">
    <img src="LogoCute.png" alt="Cute Futsal" class="h-12 md:h-16 rounded-lg shadow-md">
    <h1 class="text-lg font-bold pl-4">CUTE FUTSAL</h1>
  </a>
  <div class="hidden md:flex space-x-8 sm:flex max-sm:hidden">
    <a href="login" class="bg-white text-[#FF8FAB] px-5 py-2 rounded-full font-semibold shadow-sm hover:bg-white/90 transition duration-300">Logout</a>
  </div>
    </nav>

    
    <div class="mt-20 px-4 md:px-20 bg-gray-100 min-h-screen">
        <h2 class="text-3xl font-bold text-center text-pink-600 mb-8">Data Pemesanan Lapangan</h2>

        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tombol Tambah Data --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.pemesanan.create') }}"
               class="bg-green-400 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                + Tambah Data
            </a>
        </div>

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
                    @foreach($allPemesanan as $pemesanan)
                    <tr class="border-b hover:bg-pink-50">
                        <td class="px-6 py-4">{{ $pemesanan->nama }}</td>
                        <td class="px-6 py-4">{{ $pemesanan->no_hp }}</td>
                        <td class="px-6 py-4">{{ $pemesanan->tgl_main }}</td>
                        <td class="px-6 py-4">{{ $pemesanan->waktu_main }}</td>
                        <td class="px-6 py-4">{{ $pemesanan->lapangans->nama_lapangan ?? '-' }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('pemesanans.edit', $pemesanan->id) }}"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs">Edit</a>
                            
                            <form action="{{ route('pemesanans.destroy', $pemesanan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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

    {{-- FOOTER --}}
    @include('components.footer')
   
</body>
</html>
