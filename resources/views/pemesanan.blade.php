<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemesanan | Cute Futsal</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .gradient-bg {
            background: linear-gradient(to bottom right, #ffe4ec, #fce2ff);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="gradient-bg font-poppins min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-[#FFB3C6] shadow-md w-full py-4 px-6 md:px-40 flex items-center justify-between text-white fixed top-0 left-0 z-50">
        <a href="#" class="flex items-center">
            <img src="{{ asset('LogoFutsal.png') }}" alt="Cute Futsal" class="h-12 md:h-16">
            <h1 class="text-lg font-bold pl-4 tracking-wide">CUTE FUTSAL</h1>
        </a>
    </nav>

    {{-- Form Container --}}
    <div class="max-w-3xl mx-auto px-6 py-24 fade-in mt-10">
        <div class="bg-white shadow-xl rounded-2xl p-10">
            <h2 class="text-3xl font-bold text-center text-pink-500 mb-8">Tambah Pemesanan</h2>

            @if ($errors->any())
                <div class="mb-6 bg-red-100 text-red-600 px-4 py-3 rounded-md shadow">
                    <ul class="list-disc ml-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pemesanan.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                    <input type="text" name="no_hp" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Main</label>
                    <input type="date" name="tgl_main" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Waktu</label>
                    <input type="time" name="waktu_main" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Lapangan</label>
                    <select name="lapangan_id" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
                        <option value="">-- Pilih Lapangan --</option>
                        @foreach($lapangans as $lapangan)
                            <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end items-center gap-4 pt-4">
                    <a href="{{ route('admin.welcome') }}" class="border border-pink-500 text-pink-500 hover:bg-pink-50 font-medium px-6 py-2 rounded-lg shadow-md transition flex items-center justify-center">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Batal
                    </a>
                    <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-2 rounded-lg shadow-md transition">
                        <i class="fa-solid fa-check mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
