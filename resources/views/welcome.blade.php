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
  @include('components.header')

  {{-- Hero --}}
  <section id="hero"
    class="hero bg-cover bg-center min-h-screen w-full flex items-center justify-center px-6 lg:px-24 py-20 relative"
    style="background-image: url('bg.jpg'); ">
    <div class="absolute inset-0 bg-gray-800 opacity-60 z-0"></div>

    <div class="relative z-10 text-center space-y-6 max-w-3xl">
      <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white leading-tight">CUTE FUTSAL</h1>
      <p class="text-white text-base md:text-lg leading-relaxed">
        Main futsal makin seru di tempat yang vibes-nya beda! Lapangan kece, bersih, dan nyaman buat fun match bareng
        bestie atau sparing serius.
        Lokasi strategis, fasilitas lengkap, parkir luas, dan harga bersahabat di kantong tongkrongan. Tunggu apa lagi?
        Gaskeun booking sekarang sebelum full slot!
      </p>
      <a href="#list"
        class="inline-block bg-gray bg-pink-500 hover:bg-[#F564A9] text-white font-medium px-6 py-3 rounded-full transition duration-300">Lihat
        Selengkapnya</a>
    </div>
  </section>


  {{-- About --}}
  <section id="about"
    class="bg-gradient-to-r from-[#FAA4BD] to-[#F564A9] py-20 w-full flex items-center justify-center px-6 lg:px-24 relative">
    <!-- Background blur -->
    <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('futsal-background.jpg');">
    </div>

    <!-- Konten -->
    <div class="relative z-10 flex flex-col lg:flex-row items-center gap-10 w-full max-w-screen-lg">
      <!-- Teks -->
      <div class="flex-1 text-center lg:text-left space-y-4">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-black leading-tight underline pb-8">About</h1>
        <p class="text-base md:text-lg text-black leading-relaxed">
          CUTE FUTSAL adalah salah satu lapangan futsal paling hits di kota ini. Dikenal karena kualitas lapangannya
          yang premium dengan permukaan lantai terbaik, lighting standar pertandingan, dan fasilitas modern.
          Banyak tim lokal dan komunitas futsal yang rutin booking di sini, bahkan jadi langganan venue buat turnamen
          skala kampus hingga antar kecamatan.
          <br>
          <br>
          Tempat ini punya 3 lapangan indoor dengan sistem ventilasi maksimal, ruang tunggu nyaman, area parkir luas,
          serta spot nongkrong kece buat ngopi sambil nonton match.
          <br>
          <br>
          Cute Futsal juga udah beberapa kali kerja bareng event organizer buat turnamen skala gede. Soal harga? Tetep
          bersahabat buat semua kalangan.
          Nggak heran kalau Cute Futsal jadi destinasi favorit pecinta futsal di area sini.
        </p>
      </div>

      <!-- Gambar -->
      <div class="flex-1 flex flex-col gap-4">
        <img src="foto1.jpg" alt="Futsal Court 1"
          class="w-full h-[225px] rounded-lg shadow-2xl object-cover transform transition-transform duration-500 hover:scale-110 hover:translate-x-4 hover:translate-y-2">
        <img src="foto2.jpg" alt="Futsal Court 2"
          class="w-full h-[225px] rounded-lg shadow-2xl object-cover transform transition-transform duration-500 hover:scale-110 hover:translate-x-4 hover:translate-y-2">
      </div>


  </section>



  {{-- List Lapangan --}}
  <section id="list" class="bg-cover bg-center py-28 w-full flex items-center justify-center px-6 lg:px-24"
    style="background-image: url('foto1.jpg');">
    <div class="flex-1 text-center space-y-12">
      <div class="w-full flex flex-col items-center rounded-lg px-4 py-10"
        style="background: linear-gradient(to right, #FAA4BD, #F564A9); ">
        <h1 class="text-3xl md:text-4xl font-bold  mb-5 text-center">LAPANGAN FUTSAL PILIHAN</h1>
        <p class=" mb-10 text-xl text-center font-semibold">Ayo Pilih Lapanganmu Sekarang!!!</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 gap-y-12">

          <!-- Card 1 -->
          <div
            class="bg-white rounded-xl overflow-hidden shadow-lg w-80 transform hover:scale-105 transition-transform duration-300">
            <img src="futsal3.jpg" alt="Lapangan Futsal" class="w-full h-48 object-cover">
            <div class="p-4">
              <h2 class="text-xl font-bold mb-2 text-gray-800">Lapangan Premium</h2>
              <ul class="text-gray-700 mb-4 list-disc pl-5 text-left space-y-1">
                <li>Lantai vinyl anti-slip</li>
                <li>Ruang ganti ber-AC</li>
                <li>Free air mineral</li>
              </ul>
              <a href="{{ route('pemesanans.index') }}"
                class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded w-full text-center block transition duration-300">Pesan
                Sekarang</a>
            </div>
          </div>

          <!-- Card 2 -->
          <div
            class="bg-white rounded-xl overflow-hidden shadow-lg w-80 transform hover:scale-105 transition-transform duration-300">
            <img src="futsal2.jpg" alt="Lapangan Futsal" class="w-full h-48 object-cover">
            <div class="p-4">
              <h2 class="text-xl font-bold mb-2 text-gray-800">Lapangan Eksekutif</h2>
              <ul class="text-gray-700 mb-4 list-disc pl-5 text-left space-y-1">
                <li>Rumput sintetis internasional</li>
                <li>VIP room & ruang tunggu</li>
                <li>Free jersey & air mineral</li>
              </ul>
              <a href="{{ route('pemesanans.index') }}"
                class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded w-full text-center block transition duration-300">Pesan
                Sekarang</a>
            </div>
          </div>

          <!-- Card 3 -->
          <div
            class="bg-white rounded-xl overflow-hidden shadow-lg w-80 transform hover:scale-105 transition-transform duration-300">
            <img src="futsal1.jpg" alt="Lapangan Futsal" class="w-full h-48 object-cover">
            <div class="p-4">
              <h2 class="text-xl font-bold mb-2 text-gray-800">Lapangan Santai</h2>
              <ul class="text-gray-700 mb-4 list-disc pl-5 text-left space-y-1">
                <li>Lantai standar nyaman</li>
                <li>Ruang ganti biasa</li>
                <li>Free air mineral</li>
              </ul>
              <a href="{{ route('pemesanans.create', ['lapangans_id' => $lapangans->id]) }}"
                class="bg-pink-600 hover:bg-pink-700 text-white font-semibold py-2 px-4 rounded w-full text-center block transition duration-300">Pesan
                Sekarang</a>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>



  {{-- Footer --}}
  @include('components.footer')

</body>

</html>