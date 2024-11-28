@extends('templates.Header')
<!-- @extends('templates.Navbar') -->

<div class="container mx-auto px-5 py-10">
    @forelse ($dtHome as $DataH)
        <!-- Welcome and Voting Message -->
        <div class="w-full items-center flex flex-col md:flex-row justify-between text-center md:text-left">
            <div class="mb-8 md:mb-0">
                <h1 class="text-6xl font-bold text-blue-700 mb-4">{{ $DataH->nama_setting }}</h1>
                <h2 class="text-4xl font-semibold text-gray-800">{{ $DataH->judul_pemilihan }}</h2>
                <p class="mt-6 text-gray-700 text-xl leading-relaxed">
                    Selamat datang di sistem pemilihan digital sekolah kami! Anda memiliki hak suara yang penting 
                    dalam menentukan masa depan sekolah. Dengan memberikan suara, Anda berpartisipasi aktif dalam 
                    membentuk masa depan SMK 1 Purwokerto, sebuah sekolah yang berkomitmen mencetak lulusan yang 
                    siap bersaing di dunia industri. Setiap suara Anda adalah langkah menuju kemajuan bersama.
                </p>
                <p class="mt-4 text-gray-700 text-xl leading-relaxed">
                    Ingatlah untuk memilih dengan bijak. Setiap pilihan Anda mencerminkan harapan, kontribusi, dan 
                    tanggung jawab kita bersama demi sekolah yang lebih baik. Gunakan hak pilih Anda dengan penuh 
                    kesadaran, karena setiap suara yang Anda berikan sangat berarti.
                </p>
                <a href="/votingApp">
                    <button
                        class="px-10 py-4 hover:bg-blue-600 hover:text-white transition-colors duration-300 bg-blue-500 text-white mt-8 rounded-lg font-semibold">
                        Mulai Memilih
                    </button>
                </a>
            </div>
            <div class="flex justify-center md:justify-end w-full md:w-auto">
                <!-- Further Enlarged Logo Size with Larger Base and Responsive Adjustments -->
                <img class="w-[1200px] md:w-[1000px] lg:w-[1100px] xl:w-[1300px] 2xl:w-[1500px]" src="{{ asset('assets/smk1.png') }}" alt="School Logo">
            </div>
        </div>
    @empty
        <p class="text-center text-gray-700 text-xl">Data tidak tersedia saat ini.</p>
    @endforelse
</div>

