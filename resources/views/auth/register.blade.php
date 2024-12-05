@extends('templates.Header')

<div class="flex items-center justify-center w-full h-full min-h-screen bg-gray-100">
    <!-- Container Utama -->
    <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8 max-w-xs sm:max-w-md w-full text-center">

        <!-- Logo Sekolah -->
        <img src="{{ asset('assets/smk1.png') }}" alt="Logo Sekolah" class="mx-auto mb-4 w-20 h-20 sm:w-24 sm:h-24 object-cover">

        <!-- Judul -->
        <h1 class="text-xl sm:text-2xl font-semibold text-gray-700 mb-6">Register Admin</h1>
        <p class="text-gray-500 text-xs sm:text-sm mb-6">SMK Negeri 1 Purwokerto</p>

        <!-- Menampilkan pesan error atau sukses -->
        @if ($errors->any())
            <div class="text-red-500 text-xs sm:text-sm mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('admin.store') }}" method="POST" class="space-y-4">
            @csrf
            <!-- Input Nama Lengkap -->
            <div>
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-600 mb-2">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('nama_lengkap') }}" required>
            </div>

            <!-- Input Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-600 mb-2">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('tanggal_lahir') }}" required>
            </div>

            <!-- Input NIK -->
            <div>
                <label for="nik" class="block text-sm font-medium text-gray-600 mb-2">NIK</label>
                <input type="text" id="nik" name="nik"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('nik') }}" required>
            </div>

            <!-- Input Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                <input type="email" id="email" name="email"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('email') }}" required>
            </div>

            <!-- Input Username -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-600 mb-2">Username</label>
                <input type="text" id="username" name="username"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('username') }}" required>
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Input Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-2">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
            </div>

            <!-- Tombol Register -->
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold">
                Register
            </button>
        </form>

        <!-- Opsi Login -->
        <div class="mt-6">
            <p class="text-gray-500 text-xs sm:text-sm">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 font-medium transition duration-300">
                    Login
                </a>
            </p>
        </div>
    </div>
</div>
