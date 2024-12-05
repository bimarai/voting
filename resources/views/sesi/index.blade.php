@extends('templates.h1')

<div class="flex items-center justify-center w-full h-full min-h-screen bg-gray-100">
    <!-- Container Utama -->
    <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8 max-w-xs sm:max-w-md w-full text-center">
        
        <!-- Logo Sekolah -->
        <img src="{{ asset('assets/smk1.png') }}" alt="Logo Sekolah" class="mx-auto mb-4 w-20 h-20 sm:w-24 sm:h-24 object-cover">
        
        <!-- Judul -->
        <h1 class="text-xl sm:text-2xl font-semibold text-gray-700 mb-2">Pemilihan Ketua Osis</h1>
        <p class="text-gray-500 text-xs sm:text-sm mb-6">SMK Negeri 1 Purwokerto</p>

        <!-- Menampilkan Pesan Error -->
        @if ($pesan ?? false)
            <div class="text-red-500 text-xs sm:text-sm mb-4">
                {{ $pesan }}
            </div>
        @endif

        <!-- Form Token -->
        <form action="{{ url('/sesi/login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="token" class="block text-sm font-medium text-gray-600 mb-2">Masukkan Token</label>
                <input type="text" id="token" name="token" placeholder="Token"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold">
                Masuk
            </button>
        </form>

        <!-- Opsi Login Admin -->
        <!-- <div class="mt-6">
            <p class="text-gray-500 text-xs sm:text-sm">Masuk sebagai 
                <a href="{{ url('/login') }}" class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">
                    Admin
                </a>
            </p>
        </div> -->
    </div>
</div>

