@extends('templates.Header')

<div class="flex items-center justify-center w-full h-full min-h-screen bg-gray-100">
    <!-- Container Utama -->
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full text-center">

        <!-- Logo Sekolah -->
        <img src="{{ asset('assets/smk1.png') }}" alt="Logo Sekolah" class="mx-auto mb-4 w-24 h-24 object-cover">

        <!-- Judul -->
        <h1 class="text-2xl font-semibold text-gray-700 mb-6">Login Admin</h1>
        <p class="text-gray-500 text-sm mb-6">SMK Negeri 1 Purwokerto</p>

        <!-- Menampilkan pesan error atau sukses -->
        @if ($pesan ?? false)
            <div class="text-red-500 text-sm mb-4">
                {{ $pesan }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Input Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                <input type="email" id="email" name="email"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold">
                Login
            </button>
        </form>

        <!-- Opsi Login dengan Token -->
        <div class="mt-6">
            <p class="text-gray-500 text-sm">Login menggunakan <a href="/sesi"
                   class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">Token</a></p>
        </div>
    </div>
</div>
