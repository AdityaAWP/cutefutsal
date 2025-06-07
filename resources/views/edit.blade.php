<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemesanan | Cute Futsal</title>
    @vite(['resources/css/app.css'])

    {{-- Font & Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles

    <style>
        .gradient-bg {
            background: linear-gradient(to bottom right, #ffe4ec, #fce2ff);
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="font-poppins gradient-bg min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-[#FFB3C6] shadow-md w-full py-4 px-6 md:px-40 flex items-center justify-between text-white fixed top-0 left-0 z-50">
        <a href="#" class="flex items-center">
            <img src="{{ asset('LogoFutsal.png') }}" alt="Cute Futsal" class="h-12 md:h-16">
            <h1 class="text-lg font-bold pl-4 tracking-wide">CUTE FUTSAL</h1>
        </a>
    </nav>

    {{-- Content --}}
    <div class="max-w-2xl mx-auto py-24 px-4 fade-in">
        <h2 class="text-3xl font-bold text-center text-pink-600 mb-8">Edit Pemesanan</h2>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-600 px-4 py-3 rounded shadow-sm">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST" class="space-y-5 bg-white p-8 rounded-2xl shadow-xl">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $pemesanan->nama) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pemesanan->no_hp) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Main</label>
                <input type="date" name="tgl_main" value="{{ old('tgl_main', $pemesanan->tgl_main) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Waktu Main</label>
                <input type="time" name="waktu_main" value="{{ old('waktu_main', $pemesanan->waktu_main) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Lapangan</label>
                <select name="lapangan_id" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring focus:ring-pink-300" required>
                    <option value="">-- Pilih Lapangan --</option>
                    @foreach ($lapangans as $lapangan)
                        <option value="{{ $lapangan->id }}" {{ $pemesanan->lapangan_id == $lapangan->id ? 'selected' : '' }}>
                            {{ $lapangan->nama_lapangan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                {{-- Tombol Batal --}}
                <a href="{{ route('admin.welcome') }}"
                   class="border border-pink-500 text-pink-500 hover:bg-pink-50 font-medium px-6 py-2 rounded-lg shadow-md transition flex items-center justify-center">
                   <i class="fa-solid fa-arrow-left mr-2"></i> Batal
                </a>

                {{-- Tombol Update --}}
                <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white font-medium px-6 py-2 rounded-lg shadow-md transition flex items-center justify-center">
                    <i class="fa-solid fa-check mr-2"></i> Update
                </button>
            </div>
        </form>
    </div>

</body>

</html>
