@extends('./templates.Header')
@extends('./templates.Navbar-admin')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h1 class="text-3xl sm:text-4xl font-bold text-center mb-8 text-blue-600">Buat Token</h1>

    {{-- Bagian untuk Generate Token --}}
    <div class="bg-white rounded-lg shadow-lg p-6 space-y-6">
        {{-- Form untuk Generate Token --}}
        <form action="{{ route('generate.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <label for="jumlah" class="font-semibold text-gray-700">Total Token:</label>
                <input type="number" name="jumlah" id="jumlah"
                    class="flex-1 border border-gray-300 px-4 py-2 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Masukkan jumlah token" required>
            </div>
            <button type="submit"
                class="w-full sm:w-auto bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                Buat
            </button>
        </form>

        {{-- Tombol Ekspor dan Hapus --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center sm:justify-end">
            <a href="{{ route('generate.index') }}?export=pdf"
                class="w-full sm:w-auto bg-yellow-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300 text-center">
                Export PDF
            </a>
            <form action="{{ route('generate.deleteAll') }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua token?');" class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full sm:w-auto bg-red-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-red-600 transition duration-300">
                    Hapus Semua
                </button>
            </form>
        </div>
    </div>

    {{-- Success notification --}}
    @if (session('success'))
        <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Menampilkan Token --}}
    <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-4 mt-10">Token Tersedia:</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @foreach ($tokens as $dttoken)
            <div class="bg-white px-4 py-3 shadow rounded-lg text-center font-mono text-sm sm:text-lg">
                {{ $dttoken->token }}

                {{-- Menampilkan Penanda Status Token --}}
                @if ($dttoken->is_pakai == 1)
                    <div class="mt-2 text-red-500 font-semibold">Dipakai</div>
                @else
                    <div class="mt-2 text-green-500 font-semibold">Belum Dipakai</div>
                @endif
            </div>
        @endforeach
    </div>
</div>

{{-- Footer --}}
@extends('./templates.footer')
