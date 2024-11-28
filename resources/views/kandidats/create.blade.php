@extends('templates.Header')
@extends('templates.Navbar-Admin')

<div class="px-[7%] mx-auto">
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-semibold text-gray-800">Pendaftaran Kandidat</h2>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong>Error!</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kandidats.store') }}" method="POST" enctype="multipart/form-data" 
          class="space-y-6 bg-white p-8 rounded-lg shadow-lg">
        @csrf

        <!-- Nama Kandidat -->
        <div>
            <label class="block text-gray-600 font-medium mb-2">Nama:</label>
            <input type="text" name="nama_kandidat" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Nama Kandidat" value="{{ old('nama_kandidat') }}">
        </div>

        <!-- Foto Kandidat -->
        <div>
            <label class="block text-gray-600 font-medium mb-2">Foto:</label>
            <input type="file" name="foto" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Tanggal Lahir -->
        <div>
            <label class="block text-gray-600 font-medium mb-2">Tanggal lahir:</label>
            <input type="date" name="tanggal_lahir" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ old('tanggal_lahir') }}">
        </div>

        <!-- Tempat Lahir -->
        <div>
            <label class="block text-gray-600 font-medium mb-2">Tempat lahir:</label>
            <input type="text" name="tempat_lahir" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Tempat lahir" value="{{ old('tempat_lahir') }}">
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-gray-600 font-medium mb-2">Alamat:</label>
            <textarea name="alamat" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Alamat" rows="4">{{ old('alamat') }}</textarea>
        </div>

        <!-- Nomor Urut -->
        <div>
            <label class="block text-gray-600 font-medium mb-2">Nomor Urut:</label>
            <input type="number" name="nomor_urut" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Nomor Urut" value="{{ old('nomor_urut') }}">
        </div>

        <!-- Tombol Submit -->
        <div class="text-center">
            <button type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium">
                Submit
            </button>
        </div>
    </form>
</div>

@extends('templates.Footer')
