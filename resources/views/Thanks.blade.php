@extends('./templates/Header')


<!-- Header -->

<!-- Thank You Message -->
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg text-center">
    <div class="mb-6">
        <h1 class="text-4xl font-bold text-blue-800">Pemilihan Berhasil!</h1>
        <br>
        <p class="text-gray-700 mt-4">Pilihan Anda sangat berarti dalam menentukan pemimpin OSIS yang terbaik untuk masa depan. Pastikan untuk mendukung program-program yang akan dijalankan oleh kandidat terpilih.</p>
        <p class="mt-2 text-lg text-gray-600">Pilihan Anda telah berhasil direkam. Terima kasih telah berpartisipasi dalam pemilihan kandidat OSIS.</p>
        <br>
        <h2 class="text-2xl font-semibold text-blue-800">Terima Kasih Telah Memilih!</h2>
    </div>

    <!-- Redirect Button or Additional Message -->
    <div class="mt-6">
        <a href="{{ route('sesi.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300">
            Kembali ke Beranda
        </a>
    </div>
</div>


