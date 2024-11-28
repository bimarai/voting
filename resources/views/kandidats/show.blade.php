@extends('templates.Header')
@extends('templates.Navbar-admin')

<div class="px-[7%] ">
    <div class="px-[7%] py-[10%] mx-auto ">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-semibold text-gray-800">Show Kandidat</h2>
            <a href="{{ route('kandidats.index') }}"
                class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Back</a>
        </div>

        <div class="space-y-6 bg-white p-8 rounded-lg shadow-lg">
            <div>
                <img src="{{ asset('images/' . $kandidat->foto) }}" alt="Foto Kandidat"
                    class="w-32 h-32 object-cover rounded-md shadow-md">
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-600">Nama Kandidat:</h3>
                <p class="text-gray-800">{{ $kandidat->nama_kandidat }}</p>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-600">Alamat:</h3>
                <p class="text-gray-800">{{ $kandidat->alamat }}</p>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-600">Tanggal Lahir:</h3>
                <p class="text-gray-800">{{ $kandidat->tanggal_lahir }}</p>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-600">Tempat Lahir:</h3>
                <p class="text-gray-800">{{ $kandidat->tempat_lahir }}</p>
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-600">Nomor Urut:</h3>
                <p class="text-gray-800">{{ $kandidat->nomor_urut }}</p>
            </div>
        </div>
    </div>

</div>


@extends('templates.Footer')
