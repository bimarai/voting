@extends('templates.Header')
@extends('templates.Navbar-admin')

<div class="py-8 bg-gray-100">
    <!-- Success or Error Messages -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 mx-4 sm:mx-8 md:mx-auto max-w-2xl">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 mx-4 sm:mx-8 md:mx-auto max-w-2xl">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Form -->
    <div class="flex justify-center mb-6">
        <form action="{{ route('votingApp.index') }}" method="GET" class="flex items-center">
            <!-- Pencarian berdasarkan Nama Kandidat -->
            <input type="text" name="nama_kandidat" placeholder="Cari berdasarkan nama kandidat" 
                   class="border border-gray-300 rounded-lg px-4 py-2 w-64"
                   value="{{ request()->get('nama_kandidat') }}">

            <!-- Pencarian berdasarkan Nomor Urut -->
            <input type="number" name="nomor_urut" placeholder="No"
                   class="border border-gray-300 rounded-lg px-4 py-2 w-16 ml-4"
                   value="{{ request()->get('nomor_urut') }}">

            <!-- Tombol Cari -->
            <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">
                Cari
            </button>
        </form>
    </div>

    <!-- Candidates List -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 px-[7%]">
        @forelse ($hasilVoting as $hasil)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-lg m-4 bg-white relative border border-gray-300 transform transition-transform duration-200 hover:scale-105 hover:shadow-2xl">
                <!-- Nomor Urut -->
                <div class="absolute top-0 w-full flex justify-center mt-4">
                    <div class="bg-black text-white font-bold px-6 py-2 rounded-full shadow-md text-lg">
                        {{ $hasil->nomor_urut }}
                    </div>
                </div>

                <!-- Foto Kandidat -->
                <img class="w-full h-48 object-cover mt-12 rounded-t-lg" src="{{ asset('images/' . $hasil->foto) }}" alt="Foto Kandidat">

                <!-- Candidate Information -->
                <div class="px-6 py-4 text-center">
                    <div class="font-bold text-2xl mb-2 text-gray-800">{{ $hasil->nama_kandidat }}</div>

                    <!-- Vote Count -->
                    <div class="py-4">
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-lg font-semibold">
                            {{ $hasil->total_suara }} Suara
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-4 text-center text-gray-600">Tidak ada kandidat yang ditemukan</p>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $hasilVoting->links() }}
    </div>
</div>

@extends('templates.Footer')
