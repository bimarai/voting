@extends('templates.Header')
@extends('templates.Navbar-admin')

<div class="px-[10%] py-10">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Kandidat</h2>
        <!-- Tombol Tambah Kandidat -->
        <a href="{{ route('kandidats.create') }}" class="inline-block bg-green-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-green-600">
            Tambah Kandidat
        </a>
    </div>

    <!-- Pencarian Kandidat -->
    <div class="mb-6 p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('kandidats.index') }}" method="GET" class="space-y-3 md:space-y-0 md:flex md:items-center md:space-x-4">
            <!-- Input Nama Kandidat -->
            <div class="flex flex-col md:flex-row md:items-center">
                <label for="nama_kandidat" class="text-gray-700 font-semibold mr-2">Nama Kandidat:</label>
                <input type="text" id="nama_kandidat" name="nama_kandidat" value="{{ request()->input('nama_kandidat') }}"
                    class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nama kandidat">
            </div>
            <!-- Input Nomor Urut -->
            <div class="flex flex-col md:flex-row md:items-center">
                <label for="nomor_urut" class="text-gray-700 font-semibold mr-2">Nomor Urut:</label>
                <input type="number" id="nomor_urut" name="nomor_urut" value="{{ request()->input('nomor_urut') }}"
                    class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="No Urut">
            </div>
            <!-- Tombol Cari -->
            <button type="submit"
                class="py-2 px-6 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-200">
                Cari
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 bg-white rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">No</th>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Foto</th>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Nama Kandidat</th>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Alamat</th>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Tanggal Lahir</th>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Tempat Lahir</th>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Nomor Urut</th>
                    <th class="p-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($kandidats as $key => $dtKandidat)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="p-3 border-b text-gray-700">{{ $kandidats->firstItem() + $key }}</td>
                        <td class="p-3 border-b">
                            <img src="{{ asset('images/' . $dtKandidat->foto) }}" alt="Foto Kandidat"
                                class="w-20 h-28 object-cover rounded shadow-md">
                        </td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->nama_kandidat }}</td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->alamat }}</td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->tanggal_lahir }}</td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->tempat_lahir }}</td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->nomor_urut }}</td>
                        <td class="p-3 border-b text-gray-700 space-x-1">
                            <a href="{{ route('kandidats.show', $dtKandidat->id_kandidat) }}"
                                class="inline-block bg-blue-500 text-white py-1 px-3 rounded-lg shadow-md hover:bg-blue-600">Detail</a>
                            <a href="{{ route('kandidats.edit', $dtKandidat->id_kandidat) }}"
                                class="inline-block bg-yellow-500 text-white py-1 px-3 rounded-lg shadow-md hover:bg-yellow-600">Edit</a>
                            <form action="{{ route('kandidats.destroy', $dtKandidat->id_kandidat) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded-lg shadow-md hover:bg-red-600"
                                    onclick="return confirm('Are you sure you want to delete this candidate?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center items-center space-x-2">
        @if ($kandidats->onFirstPage())
            <span class="text-gray-400">Previous</span>
        @else
            <a href="{{ $kandidats->previousPageUrl() }}" class="text-blue-500 font-medium hover:underline">Previous</a>
        @endif

        @foreach ($kandidats->getUrlRange(1, $kandidats->lastPage()) as $page => $url)
            <a href="{{ $url }} "
                class="{{ $page == $kandidats->currentPage() ? 'bg-blue-500 text-white px-3 py-1 rounded-lg' : 'text-blue-500 font-medium hover:underline' }}">
                {{ $page }}
            </a>
        @endforeach

        @if ($kandidats->hasMorePages())
            <a href="{{ $kandidats->nextPageUrl() }}" class="text-blue-500 font-medium hover:underline">Next</a>
        @else
            <span class="text-gray-400">Next</span>
        @endif
    </div>
</div>

@extends('templates.Footer')
