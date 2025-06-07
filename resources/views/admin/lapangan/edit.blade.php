<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lapangan - Cute Futsal</title>
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
            <a href="{{ route('admin.lapangan.index') }}">Lapangan</a>
            <a href="{{ route('admin.welcome') }}">Pemesanan</a>
            <a href="login"
                class="bg-white text-[#FF8FAB] px-5 py-2 rounded-full font-semibold shadow-sm hover:bg-white/90 transition duration-300">Logout</a>
        </div>
    </nav>

    <div class="mt-20 px-4 md:px-20 bg-gray-100 min-h-screen my-9">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('admin.lapangan.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition duration-300 flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <h2 class="text-3xl font-bold text-pink-600">Edit Lapangan: {{ $lapangan->nama_lapangan }}</h2>
            </div>

            @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white p-8 rounded-lg shadow-md">
                <form action="{{ route('admin.lapangan.update', $lapangan->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Lapangan --}}
                        <div class="md:col-span-2">
                            <label for="nama_lapangan" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-futbol text-pink-500 mr-2"></i>
                                Nama Lapangan *
                            </label>
                            <input type="text" name="nama_lapangan" id="nama_lapangan"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500 @error('nama_lapangan') border-red-500 @enderror"
                                placeholder="Contoh: Lapangan A"
                                value="{{ old('nama_lapangan', $lapangan->nama_lapangan) }}" required>
                            @error('nama_lapangan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tipe --}}
                        <div>
                            <label for="tipe" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-tag text-pink-500 mr-2"></i>
                                Tipe Lapangan *
                            </label>
                            <select name="tipe" id="tipe"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500 @error('tipe') border-red-500 @enderror"
                                required>
                                <option value="">Pilih Tipe</option>
                                <option value="Indoor" {{ old('tipe', $lapangan->tipe) == 'Indoor' ? 'selected' : ''
                                    }}>Indoor</option>
                                <option value="Outdoor" {{ old('tipe', $lapangan->tipe) == 'Outdoor' ? 'selected' : ''
                                    }}>Outdoor</option>
                                <option value="Sintetis" {{ old('tipe', $lapangan->tipe) == 'Sintetis' ? 'selected' : ''
                                    }}>Sintetis</option>
                                <option value="Vinyl" {{ old('tipe', $lapangan->tipe) == 'Vinyl' ? 'selected' : ''
                                    }}>Vinyl</option>
                            </select>
                            @error('tipe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga per Jam --}}
                        <div>
                            <label for="harga_per_jam" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-money-bill-wave text-pink-500 mr-2"></i>
                                Harga per Jam *
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                                <input type="number" name="harga_per_jam" id="harga_per_jam"
                                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500 @error('harga_per_jam') border-red-500 @enderror"
                                    placeholder="100000" value="{{ old('harga_per_jam', $lapangan->harga_per_jam) }}"
                                    min="0" required>
                            </div>
                            @error('harga_per_jam')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Spesifikasi --}}
                        <div class="md:col-span-2">
                            <label for="spesifikasi" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-list-ul text-pink-500 mr-2"></i>
                                Spesifikasi Lapangan
                            </label>
                            <textarea name="spesifikasi" id="spesifikasi" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-pink-500 focus:border-pink-500 @error('spesifikasi') border-red-500 @enderror"
                                placeholder="Contoh: Ukuran 20x40m, Rumput sintetis, Lighting LED, Tribun penonton 50 orang">{{ old('spesifikasi', $lapangan->spesifikasi) }}</textarea>
                            @error('spesifikasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Current Image --}}
                        @if($lapangan->gambar)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-image text-pink-500 mr-2"></i>
                                Gambar Saat Ini
                            </label>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <img src="{{ asset('images/lapangan/' . $lapangan->gambar) }}"
                                    alt="{{ $lapangan->nama_lapangan }}" class="w-24 h-24 object-cover rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-600">{{ $lapangan->gambar }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Upload gambar baru untuk mengganti yang lama
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Upload New Image with Preview --}}
                        <div class="md:col-span-2">
                            <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-camera text-pink-500 mr-2"></i>
                                {{ $lapangan->gambar ? 'Ganti Gambar Lapangan' : 'Upload Gambar Lapangan' }}
                            </label>

                            {{-- Image Preview Container --}}
                            <div id="imagePreviewContainer" class="hidden mb-4">
                                <div class="flex items-center gap-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                                    <img id="imagePreview" src="" alt="Preview"
                                        class="w-24 h-24 object-cover rounded-lg">
                                    <div>
                                        <p class="text-sm text-green-700 font-medium">Gambar baru dipilih</p>
                                        <p id="fileName" class="text-xs text-green-600 mt-1"></p>
                                        <button type="button" id="removeImage"
                                            class="text-xs text-red-600 hover:text-red-800 mt-1 underline">
                                            Hapus gambar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload Area --}}
                            <div id="uploadArea"
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-pink-400 transition duration-300 cursor-pointer">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="gambar"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-pink-600 hover:text-pink-500">
                                            <span>Upload gambar baru</span>
                                            <input id="gambar" name="gambar" type="file" class="sr-only"
                                                accept="image/*">
                                        </label>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 2MB</p>
                                </div>
                            </div>
                            @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex gap-4 mt-8 pt-6 border-t">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-[#FAA4BD] to-[#F564A9] text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i>
                            Update Lapangan
                        </button>
                        <a href="{{ route('admin.lapangan.index') }}"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    @include('components.footer')

    {{-- Enhanced JavaScript with Image Preview --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('gambar');
            const imagePreview = document.getElementById('imagePreview');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const fileName = document.getElementById('fileName');
            const removeImageBtn = document.getElementById('removeImage');
            const uploadArea = document.getElementById('uploadArea');

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (!file.type.startsWith('image/')) {
                        alert('Silakan pilih file gambar yang valid');
                        imageInput.value = '';
                        return;
                    }

                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file harus kurang dari 2MB');
                        imageInput.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        fileName.textContent = file.name;
                        imagePreviewContainer.classList.remove('hidden');
                        uploadArea.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                imagePreview.src = '';
                fileName.textContent = '';
                imagePreviewContainer.classList.add('hidden');
                uploadArea.classList.remove('hidden');
            });

            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.classList.add('border-pink-500', 'bg-pink-50');
            });

            uploadArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-pink-500', 'bg-pink-50');
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.classList.remove('border-pink-500', 'bg-pink-50');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const dt = new DataTransfer();
                    dt.items.add(files[0]);
                    imageInput.files = dt.files;
                    imageInput.dispatchEvent(new Event('change'));
                }
            });
        });
    </script>

    @livewireScripts
</body>

</html>