@extends('templates.h1')

<div class="py-8 bg-gray-100">
    <!-- Pesan Sukses atau Error -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Pencarian -->
    <div class="flex justify-center mb-6">
        <form action="{{ route('votingApp.index') }}" method="GET" class="flex items-center">
            <input type="text" name="search" placeholder="Cari nama kandidat atau nomor urut"
                   class="border border-gray-300 rounded-lg px-4 py-2 w-64"
                   value="{{ request()->get('search') }}">
            <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                Cari
            </button>
        </form>
    </div>

    <!-- Daftar Kandidat -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 px-[7%]">
        @forelse ($dtpilih as $pilih)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-lg m-4 bg-white relative border border-gray-300 transform transition-transform duration-200 hover:scale-105 hover:shadow-2xl">
                
                <!-- Nomor Urut -->
                <div class="absolute top-0 w-full flex justify-center mt-4">
                    <div class="bg-black text-white font-bold px-6 py-2 rounded-full shadow-md text-lg">
                        {{ $pilih->nomor_urut }}
                    </div>
                </div>

                <!-- Foto Kandidat -->
                <img class="w-full h-48 object-cover mt-12 rounded-t-lg" src="{{ asset('images/' . $pilih->foto) }}" alt="Foto Kandidat">

                <!-- Informasi Kandidat -->
                <div class="px-6 py-4 text-center">
                    <div class="font-bold text-2xl mb-2 text-gray-800">{{ $pilih->nama_kandidat }}</div>

                    <!-- Tombol Pilih -->
                    <div class="py-4">
                        <form action="{{ route('votingApp.store', $pilih->id_kandidat) }}" method="POST" 
                              onsubmit="return confirm('Apakah sudah yakin dengan pilihan Anda?')">
                            @csrf
                            @if (session('voted'))
                                <button type="button" class="bg-gray-400 text-white font-semibold py-2 px-6 rounded-lg shadow-md cursor-not-allowed" disabled>
                                    Sudah Memilih
                                </button>
                            @elseif ($tokenStatus == 1)
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg">
                                    Pilih
                                </button>
                            @elseif ($tokenStatus == 0)
                                <button type="button" class="bg-gray-400 text-white font-semibold py-2 px-6 rounded-lg shadow-md cursor-not-allowed" disabled>
                                    Token Sudah Digunakan
                                </button>
                            @else
                                <button type="button" class="bg-gray-400 text-white font-semibold py-2 px-6 rounded-lg shadow-md cursor-not-allowed" disabled>
                                    Token Tidak Valid
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-4 text-center text-gray-600">Tidak ada kandidat yang ditemukan</p>
        @endforelse
    </div>
</div>
