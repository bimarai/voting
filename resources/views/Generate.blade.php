@extends('./templates.Header')
@extends('./templates.Navbar-admin')

<div class="container mx-auto p-6">
    <h1 class="text-5xl font-bold text-center mb-8 text-blue-600">Generate Token</h1>

    {{-- Bagian untuk Generate Token --}}
    <div class="bg-gradient-to-r from-gray-100 via-white to-gray-50 rounded-lg shadow-lg p-8">
        {{-- Form untuk Generate Token --}}
        <form action="{{ route('generate.store') }}" method="POST" class="flex flex-wrap gap-4 items-center">
            @csrf
            {{-- Input jumlah dan tombol Generate --}}
            <label for="jumlah" class="font-semibold text-gray-700">Total Tokens:</label>
            <input type="number" name="jumlah" id="jumlah"
                class="border border-gray-300 px-6 py-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition w-full sm:w-80" 
                placeholder="Enter token amount" required>
            <button type="submit"
                class="bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition duration-300 w-full sm:w-auto mt-4 sm:mt-0 sm:ml-4">
                Generate
            </button>
        </form>

        {{-- Tombol Export PDF --}}
        <a href="{{ route('generate.index') }}?export=pdf" class="mt-4 sm:ml-4 inline-block">
            <button
                class="bg-yellow-500 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300 w-full sm:w-auto">
                Export PDF
            </button>
        </a>

        {{-- Tombol Delete All --}}
        <form action="{{ route('generate.deleteAll') }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete all tokens?');" class="mt-4 sm:ml-4 inline-block">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-500 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-red-600 transition duration-300 w-full sm:w-auto">
                Delete All
            </button>
        </form>
    </div>

    {{-- Success notification --}}
    @if (session('success'))
        <div class="alert alert-success bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mt-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-semibold text-gray-800 mb-4 mt-10">Generated Tokens:</h2>

    {{-- Menampilkan Token --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @foreach ($tokens as $dttoken)
            <div class="bg-white px-5 py-4 shadow rounded-lg border border-gray-200 text-center font-mono text-lg text-gray-700">
                {{ $dttoken->token }}
                
                {{-- Menampilkan Penanda Status Token --}}
                @if ($dttoken->is_pakai == 1)
                    <div class="mt-2 text-red-500 font-semibold">Used</div>
                @else
                    <div class="mt-2 text-green-500 font-semibold">Unused</div>
                @endif
            </div>
        @endforeach
    </div>
</div>

{{-- Footer --}}
@extends('./templates.footer') 
