@extends('templates.Header')
@extends('templates.Navbar-admin')

<div class="px-[7%] py-[5%] mx-auto bg-white shadow-lg rounded-lg">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-semibold text-gray-800">Edit Kandidat</h2>
        <a href="{{ route('kandidats.index') }}"
            class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Back</a>
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

    <form action="{{ route('kandidats.update', $kandidat->id_kandidat) }}" method="POST" enctype="multipart/form-data"
        class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-600 font-medium mb-2">Nama Kandidat:</label>
            <input type="text" name="nama_kandidat" value="{{ $kandidat->nama_kandidat }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Nama Kandidat">
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-2">Nomor Urut:</label>
            <input type="text" name="nomor_urut" value="{{ $kandidat->nomor_urut }}"
                class="w-full px-4 text-blue-500 text-4xl py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Nomor Urut">
        </div>



        <div>
            @if ($kandidat->foto)
                <img src="{{ asset('images/' . $kandidat->foto) }}" alt="Foto Kandidat"
                    class="mt-4 w-40 h-40 object-cover rounded-xl border">
            @endif
            <label class="block text-gray-600 font-medium mb-2">Foto:</label>
            <input type="file" name="foto"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-2">Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" value="{{ $kandidat->tanggal_lahir }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-2">Tempat Lahir:</label>
            <input type="text" name="tempat_lahir" value="{{ $kandidat->tempat_lahir }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Tempat Lahir">
        </div>

        <div>
            <label class="block text-gray-600 font-medium mb-2">Alamat:</label>
            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                name="alamat" placeholder="Alamat" rows="4">{{ $kandidat->alamat }}</textarea>
        </div>

        <div class="text-center">
            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium">Submit</button>
        </div>
    </form>
</div>

@extends('templates.Footer')
