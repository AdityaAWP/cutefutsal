<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CuteFutsal</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gradient-to-br from-pink-200 to-purple-300 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white shadow-2xl rounded-3xl max-w-md w-full p-8 relative">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('LogoCute.png') }}" alt="Logo" class="h-20 w-auto">
        </div>
        <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Create Your Account on <span
                class="text-pink-500">CuteFutsal</span> 🎉</h2>
        <p class="text-center text-sm text-gray-500 mb-4">Registrasi sekarang untuk mulai reservasi lapangan & nikmati
            fasilitas kami!</p>

        @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-medium mb-1">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-1">Confirm
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-transparent transition">
            </div>

            <button type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 rounded-xl shadow-md transition duration-300">
                Register
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Sudah Punya Akun? <a href="{{ route('login') }}"
                    class="text-pink-500 font-medium hover:underline">Login</a>
            </p>
        </div>
    </div>

</body>

</html>