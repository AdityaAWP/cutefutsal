<nav
  class="bg-gradient-to-r from-[#FAA4BD] to-[#F564A9] shadow-lg w-full py-4 px-6 md:px-40 flex items-center justify-between fixed top-0 left-0 z-50 backdrop-blur-md">
  <a href="/" class="flex items-center space-x-4">
    <img src="LogoCute.png" alt="Cute Futsal" class="h-12 md:h-16 rounded-lg ">
    <h1 class="text-2xl font-medium tracking-wide">CUTE FUTSAL</h1>
  </a>

  <div class="hidden md:flex space-x-10 items-center font-medium text-lg">
    <a href="/"
      class="relative hover:text-white/90 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">Home</a>
    <a href="#about"
      class="relative hover:text-white/90 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">About</a>
    <a href="#list"
      class="relative hover:text-white/90 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">Pesan</a>
    <a href="#footer"
      class="relative hover:text-white/90 after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-white after:transition-all after:duration-300 hover:after:w-full">Contact</a>

    @auth
    <!-- If the user is logged in, show logout button and email -->
    <span class="text-white">{{ Auth::user()->email }}</span>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
        class="bg-white text-[#FF8FAB] px-5 py-2 rounded-full font-semibold shadow-sm hover:bg-white/90 transition duration-300">Logout</button>
    </form>
    @else
    <!-- If the user is not logged in, show login button -->
    <a href="{{ route('login') }}"
      class="bg-white text-[#FF8FAB] px-5 py-2 rounded-full font-semibold shadow-sm hover:bg-white/90 transition duration-300">Login</a>
    @endauth
  </div>
</nav>