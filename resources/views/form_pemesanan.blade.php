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

<body class="bg-white font-poppins">

    <!-- Navbar -->
    @include('components.header')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mt-24">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Side - Image -->
            <div class="order-2 lg:order-1">
                <div class="relative">
                    @if($selectedLapangan)
                    <img src="{{ $selectedLapangan->gambar ? asset('images/lapangan/' . $selectedLapangan->gambar) : asset('futsal1.jpg') }}"
                        alt="{{ $selectedLapangan->nama_lapangan }}"
                        class="rounded-2xl shadow-2xl w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-2xl"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-2xl font-bold mb-2">{{ $selectedLapangan->nama_lapangan }}</h3>
                        <p class="text-lg opacity-90">{{ $selectedLapangan->tipe }}</p>
                        <p class="text-xl font-bold mt-2">Rp {{ number_format($selectedLapangan->harga_per_jam, 0, ',',
                            '.') }}/jam</p>
                    </div>
                    @else
                    <img src="{{ asset('futsal1.jpg') }}" alt="Lapangan Futsal"
                        class="rounded-2xl shadow-2xl w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-2xl"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-2xl font-bold mb-2">Lapangan Futsal Premium</h3>
                        <p class="text-lg opacity-90">Fasilitas lengkap & berkualitas tinggi</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="order-1 lg:order-2">
                <div class="bg-white p-8 rounded-xl shadow-2xl border-0">
                    <div class="text-center pb-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Form Pemesanan Lapangan</h2>
                        <p class="text-gray-600">Isi data berikut untuk memesan lapangan futsal</p>

                        <!-- Welcome message for authenticated users -->
                        @if(isset($user) && $user)
                        <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-green-700 font-medium">
                                <i class="fas fa-user-check mr-2"></i>
                                Selamat datang, {{ $user->name }}!
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Selected Lapangan Info -->
                    @if($selectedLapangan)
                    <div class="mb-6 p-4 bg-pink-50 border border-pink-200 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-semibold text-gray-800">Lapangan Terpilih:</h4>
                                <p class="text-pink-600 font-medium">{{ $selectedLapangan->nama_lapangan }}</p>
                                <p class="text-sm text-gray-600">{{ $selectedLapangan->tipe }}</p>
                                <p class="text-lg font-bold text-pink-600 mt-1">Rp {{
                                    number_format($selectedLapangan->harga_per_jam, 0, ',', '.') }}/jam</p>
                            </div>
                            <div class="text-pink-500">
                                <i class="fas fa-futbol text-2xl"></i>
                            </div>
                        </div>

                        @if($selectedLapangan->spesifikasi)
                        <div class="mt-3">
                            <p class="text-sm font-medium text-gray-700 mb-2">Spesifikasi:</p>
                            <ul class="text-sm text-gray-600 list-disc pl-4 space-y-1">
                                @foreach(explode(',', $selectedLapangan->spesifikasi) as $spec)
                                <li>{{ trim($spec) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    @endif

                    <div class="space-y-6">
                        @if (session('success'))
                        <div
                            class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-center font-semibold">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('pemesanans.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Hidden input for selected lapangan -->
                            @if($selectedLapangan)
                            <input type="hidden" name="lapangan_id" value="{{ $selectedLapangan->id }}">
                            @endif

                            <!-- Nama -->
                            <div class="space-y-2">
                                <label for="nama" class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                    <i class="fas fa-user text-sm"></i>
                                    Nama Lengkap
                                    @if(isset($user) && $user)
                                    <span class="text-xs text-green-600">(Pre-filled)</span>
                                    @endif
                                </label>
                                <input type="text" id="nama" name="nama"
                                    value="{{ isset($user) && $user ? $user->name : old('nama') }}"
                                    placeholder="Masukkan nama lengkap"
                                    class="mt-1 block w-full px-4 py-3 h-12 border rounded-md focus:ring-2 focus:ring-[#FFB3C6] focus:border-[#FFB3C6] focus:outline-none @error('nama') border-red-500 @enderror"
                                    required>
                                @if(isset($user) && $user)
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-edit mr-1"></i>
                                    Nama dari akun login, dapat diedit jika diperlukan
                                </p>
                                @endif
                            </div>

                            <!-- Nomor HP -->
                            <div class="space-y-2">
                                <label for="no_hp" class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                    <i class="fas fa-phone text-sm"></i>
                                    Nomor HP
                                </label>
                                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                    placeholder="08xxxxxxxxxx"
                                    class="mt-1 block w-full px-4 py-3 h-12 border rounded-md focus:ring-2 focus:ring-[#FFB3C6] focus:border-[#FFB3C6] focus:outline-none @error('no_hp') border-red-500 @enderror"
                                    required>
                            </div>

                            <!-- Tanggal -->
                            <div class="space-y-2">
                                <label for="tgl_main" class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                    <i class="fas fa-calendar text-sm"></i>
                                    Tanggal Main
                                </label>
                                <input type="date" id="tgl_main" name="tgl_main" value="{{ old('tgl_main') }}"
                                    class="mt-1 block w-full px-4 py-3 h-12 border rounded-md focus:ring-2 focus:ring-[#FFB3C6] focus:border-[#FFB3C6] focus:outline-none @error('tgl_main') border-red-500 @enderror"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>

                            <!-- Waktu -->
                            <div class="space-y-2">
                                <label for="waktu_main"
                                    class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                    <i class="fas fa-clock text-sm"></i>
                                    Waktu Main
                                </label>
                                <input type="time" id="waktu_main" name="waktu_main" value="{{ old('waktu_main') }}"
                                    class="mt-1 block w-full px-4 py-3 h-12 border rounded-md focus:ring-2 focus:ring-[#FFB3C6] focus:border-[#FFB3C6] focus:outline-none @error('waktu_main') border-red-500 @enderror"
                                    required>
                            </div>

                            <!-- Lapangan (only show if no selected lapangan) -->
                            @if(!$selectedLapangan)
                            <div class="space-y-2">
                                <label for="lapangan_id"
                                    class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-sm"></i>
                                    Pilih Lapangan
                                </label>
                                <select id="lapangan_id" name="lapangan_id"
                                    class="mt-1 block w-full px-4 py-3 h-12 border rounded-md focus:ring-2 focus:ring-[#FFB3C6] focus:border-[#FFB3C6] focus:outline-none @error('lapangan_id') border-red-500 @enderror"
                                    required>
                                    <option value="">-- Pilih Lapangan --</option>
                                    @foreach ($lapangans as $lapangan)
                                    <option value="{{ $lapangan->id }}" {{ old('lapangan_id')==$lapangan->id ?
                                        'selected' : '' }}>
                                        {{ $lapangan->nama_lapangan }} - Rp{{ number_format($lapangan->harga_per_jam, 0,
                                        ',', '.') }}/jam
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <!-- Change Lapangan Option -->
                            @if($selectedLapangan)
                            <div class="text-center">
                                <a href="{{ route('pemesanans.create') }}"
                                    class="text-pink-600 hover:text-pink-800 font-medium text-sm">
                                    <i class="fas fa-exchange-alt mr-2"></i>Ganti Lapangan
                                </a>
                            </div>
                            @endif

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full h-12 bg-[#FFB3C6] hover:bg-pink-400 text-black font-semibold py-3 px-4 rounded-md transition duration-300 transform hover:scale-[1.02] text-lg">
                                Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>