@extends('templates.Header')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @forelse ($dtHome as $DataH)
        <!-- Welcome and Voting Message -->
        <div class="flex flex-col-reverse lg:flex-row items-center lg:items-start justify-between lg:space-x-10 text-center lg:text-left">
            
            <!-- Teks Sambutan -->
            <div class="lg:w-1/2 space-y-6">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-blue-700 mb-4">
                    {{ $DataH->nama_setting }}
                </h1>
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-gray-800">
                    {{ $DataH->judul_pemilihan }}
                </h2>
                <p class="mt-4 text-gray-700 text-sm sm:text-base lg:text-lg leading-relaxed">
                    Selamat datang di sistem pemilihan digital sekolah kami! Anda memiliki hak suara yang penting 
                    dalam menentukan masa depan sekolah. Dengan memberikan suara, Anda berpartisipasi aktif dalam 
                    membentuk masa depan SMK 1 Purwokerto, sebuah sekolah yang berkomitmen mencetak lulusan yang 
                    siap bersaing di dunia industri. Setiap suara Anda adalah langkah menuju kemajuan bersama.
                </p>
                <p class="text-gray-700 text-sm sm:text-base lg:text-lg leading-relaxed">
                    Ingatlah untuk memilih dengan bijak. Setiap pilihan Anda mencerminkan harapan, kontribusi, dan 
                    tanggung jawab kita bersama demi sekolah yang lebih baik. Gunakan hak pilih Anda dengan penuh 
                    kesadaran, karena setiap suara yang Anda berikan sangat berarti.
                </p>
                <a href="/sesi">
                    <button
                        class="px-6 sm:px-8 py-3 sm:py-4 hover:bg-blue-600 hover:text-white transition-colors duration-300 bg-blue-500 text-white mt-6 rounded-lg font-semibold text-sm sm:text-base">
                        Mulai Memilih
                    </button>
                </a>
            </div>

            <!-- Gambar Logo -->
            <div class="w-full lg:w-1/2 mb-10 lg:mb-0 flex justify-center lg:justify-end">
                <img class="max-w-full h-auto rounded-lg shadow-md"
                     src="{{ asset('storage/assets/' . $DataH->logo) }}" 
                     alt="School Logo">
            </div>
        </div>
    @empty
        <p class="text-center text-gray-700 text-lg sm:text-xl">
            Data tidak tersedia saat ini.
        </p>
    @endforelse
</div>
