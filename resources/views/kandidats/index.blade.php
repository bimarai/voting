@extends('templates.Header')
@extends('templates.Navbar-admin')

<div class="px-[10%] py-10">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Kandidat</h2>
    </div>

    <!-- Pencarian Kandidat -->
    <div class="mb-6 p-4 bg-white rounded-lg shadow-md">
        <form action="{{ route('kandidats.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 md:space-x-4">
            <input type="text" name="search" value="{{ request()->input('search') }}"
                   class="p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-auto"
                   placeholder="Cari nama kandidat atau nomor urut">
            <button type="submit" 
                    class="py-2 px-6 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition duration-200">
                Cari
            </button>
            <a href="{{ route('kandidats.create') }}" class="inline-block bg-green-500 text-white py-2 px-6 rounded-lg shadow-md hover:bg-green-600">
                Tambah Kandidat
            </a>
        </form>
    </div>

    <!-- Tabel Kandidat -->
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
                            <div class="w-16 h-20 sm:w-20 sm:h-28 overflow-hidden rounded shadow-md">
                                <img src="{{ asset('images/' . $dtKandidat->foto) }}" alt="Foto Kandidat"
                                    class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->nama_kandidat }}</td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->alamat }}</td>
                        <td class="p-3 border-b text-gray-700">{{ \Carbon\Carbon::parse($dtKandidat->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->tempat_lahir }}</td>
                        <td class="p-3 border-b text-gray-700">{{ $dtKandidat->nomor_urut }}</td>
                        <td class="p-3 border-b text-gray-700">
                            <div class="flex justify-center space-x-3 items-center text-lg">
                                <!-- Detail -->
                                <a href="{{ route('kandidats.show', $dtKandidat->id_kandidat) }}" 
                                   class="text-blue-500 hover:text-blue-700" 
                                   title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <!-- Edit -->
                                <a href="{{ route('kandidats.edit', $dtKandidat->id_kandidat) }}" 
                                   class="text-yellow-500 hover:text-yellow-700" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Delete -->
                                <form action="{{ route('kandidats.destroy', $dtKandidat->id_kandidat) }}" 
                                      method="POST" 
                                      class="inline-block"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kandidat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-700" 
                                            title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
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
                class="{{ $page == $kandidats->currentPage() ? 'bg-blue-500 text-white px-3 py-1 rounded-lg' : 'text-blue-500 font-medium hover:underline' }} ">
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
