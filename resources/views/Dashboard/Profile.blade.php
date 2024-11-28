@extends('templates.Header')
@extends('templates.Navbar-Admin')

<div class="p-6 bg-gradient-to-r from-blue-100 to-purple-200 min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-4xl mx-auto pt-12">
        <h2 class="text-4xl font-semibold text-gray-800 mb-8 text-center">Profil Pengguna</h2>

        <!-- Profile Image -->
        <div class="flex justify-center mb-8">
            <img class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-md" src="{{ asset('assets/admin.png') }}"
                alt="Profile Picture">
        </div>

        <div class="space-y-6">
            <!-- Name -->
            <div class="flex justify-between items-center">
                <span class="text-xl font-medium text-gray-700">Nama Lengkap:</span>
                <span class="text-xl text-gray-600">{{ $admin->nama_lengkap }}</span>
            </div>

            <!-- Username -->
            <div class="flex justify-between items-center">
                <span class="text-xl font-medium text-gray-700">Username:</span>
                <span class="text-xl text-gray-600">{{ $admin->username }}</span>
            </div>

            <!-- Email -->
            <div class="flex justify-between items-center">
                <span class="text-xl font-medium text-gray-700">Email:</span>
                <span class="text-xl text-gray-600">{{ $admin->email }}</span>
            </div>

            <!-- Date of Birth -->
            <div class="flex justify-between items-center">
                <span class="text-xl font-medium text-gray-700">Tanggal Lahir:</span>
                <span class="text-xl text-gray-600">{{ $admin->tanggal_lahir }}</span>
            </div>

            <!-- NIK -->
            <div class="flex justify-between items-center">
                <span class="text-xl font-medium text-gray-700">NIK:</span>
                <span class="text-xl text-gray-600">{{ $admin->nik }}</span>
            </div>
        </div>

        {{-- Uncomment the next line if you want to display the created_at field --}}
        {{-- <div class="flex justify-between mt-6">
            <span class="text-xl font-medium text-gray-700">Created At:</span>
            <span class="text-xl text-gray-600">{{ $admin->created_at->format('d-m-Y H:i') }}</span>
        </div> --}}
    </div>
</div>
