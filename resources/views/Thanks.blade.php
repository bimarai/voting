@extends('./templates/h1')

<!-- Header -->

<!-- Thank You Message -->
<div class="flex items-center justify-center w-full h-full min-h-screen bg-gray-100">
    <!-- Container Utama -->
    <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8 lg:p-10 max-w-xs sm:max-w-md lg:max-w-lg mx-auto text-center">
        
        <!-- Pesan Terima Kasih -->
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-800">
                Pemilihan Berhasil!
            </h1>
            <p class="text-gray-700 mt-4 text-sm sm:text-base lg:text-lg">
                Pilihan Anda sangat berarti dalam menentukan pemimpin OSIS yang terbaik untuk masa depan. Pastikan untuk mendukung program-program yang akan dijalankan oleh kandidat terpilih.
            </p>
            <p class="mt-2 text-gray-600 text-sm sm:text-base lg:text-lg">
                Pilihan Anda telah berhasil direkam. Terima kasih telah berpartisipasi dalam pemilihan kandidat OSIS.
            </p>
            <h2 class="mt-4 text-lg sm:text-xl lg:text-2xl font-semibold text-blue-800">
                Terima Kasih Telah Memilih!
            </h2>
        </div>

        <!-- Tombol Redirect -->
        <div class="mt-6">
            <a href="{{ route('home') }}" 
               class="w-full bg-blue-500 text-white py-2 px-4 sm:px-6 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 transition-all duration-300 text-sm sm:text-base">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<!-- Auto Redirect Script -->
<!-- <script>
    // Redirect ke halaman Home setelah 5 detik
    setTimeout(() => {
        window.location.href = "{{ route('home') }}";
    }, 5000); // 5000 ms = 5 detik
</script> -->
