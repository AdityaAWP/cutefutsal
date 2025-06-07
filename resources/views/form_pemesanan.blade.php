<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cute Futsal - Form Pemesanan</title>
    @vite(['resources/css/app.css'])

    <!-- Font & Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-100 font-[Poppins]">

    <!-- Navbar -->
    @include('components.header')

    <!-- Banner -->
    <div class="w-full flex justify-center mt-24">
        <img src="futsal1.jpg" alt="Lapangan Futsal" class="rounded-lg shadow-lg w-full max-w-2xl">
    </div>

    <!-- FORM PEMESANAN -->
    <div class="flex items-center justify-center px-4 py-10 bg-gray-100">
        <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-lg">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Form Pemesanan Lapangan</h2>

            @if (session('success'))
            <div class="mb-4 text-green-600 font-semibold text-center">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('pemesanans.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        required>
                </div>

                <!-- Nomor HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="tel" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        required>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tgl_main" class="block text-sm font-medium text-gray-700">Tanggal Main</label>
                    <input type="date" id="tgl_main" name="tgl_main"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        required>
                </div>

                <!-- Waktu -->
                <div>
                    <label for="waktu_main" class="block text-sm font-medium text-gray-700">Waktu Main</label>
                    <input type="time" id="waktu_main" name="waktu_main"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        required>
                </div>

                <!-- Lapangan -->
                <div>
                    <label for="lapangan_id" class="block text-sm font-medium text-gray-700">Pilih Lapangan</label>
                    <select id="lapangan_id" name="lapangan_id"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-pink-400 focus:outline-none"
                        required>
                        <option value="">-- Pilih Lapangan --</option>
                        @foreach ($lapangans as $lapangan)
                        <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }} - Rp{{
                            number_format($lapangan->harga_per_jam) }}/jam</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-[#FFB3C6] hover:bg-pink-600 text-black font-semibold py-2 px-4 rounded-md transition duration-300">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>