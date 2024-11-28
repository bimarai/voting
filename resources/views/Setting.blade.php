@extends('./templates/Header')
@extends('./templates/Navbar-admin')
<div class="flex justify-center mt-8 h-[full] lg:h-[100vh]">
    <form action="{{ route('settings.update', $setting->id_setting) }}" method="POST"
        class="w-full bg-white p-6 rounded-lg shadow-md space-y-4 px-[10%]" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h1 class="text-5xl font-bold">Detail Settings E-Voting</h1>
        <br><br>

        <div class="lg:flex gap-5 w-full">
            <!-- ID Setting (Read-only) -->
            <div class="flex flex-col lg:w-[10%]">
                <label for="setting-id" class="mb-1 text-gray-700 font-semibold">ID Setting</label>
                <input value="1" name="id_setting" type="number" id="setting-id"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    readonly>
                <p class="text-yellow-600 text-xs">tidak perlu di ubah</p>
            </div>
            <br>
            <!-- Nama Setting -->
            <div class="flex flex-col lg:w-[30%]">
                <label for="setting-name" class="mb-1 text-gray-700 font-semibold">Nama Setting</label>
                <input value="{{ $setting->nama_setting }}" name="nama_setting" type="text" id="setting-name"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <br>

            <!-- Judul Pemilihan -->
            <div class="flex flex-col lg:w-[30%]">
                <label for="judul-pemilihan" class="mb-1 text-gray-700 font-semibold">Judul Pemilihan</label>
                <input value="{{ $setting->judul_pemilihan }}" name="judul_pemilihan" type="text"
                    id="judul-pemilihan"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <br>
            <div class="flex gap-5">
                @if ($setting->logo)
                    <img style="width: 70px; height: 70px;" src="{{ asset('assets/' . $setting->logo) }}"
                        alt="">
                @endif
                <div>
                    <label for="logo">Logo: </label>
                    <input type="file" name="logo" id="logo" accept="image/*">
                    <p class="text-yellow-500 text-xs">Ukuran file max 2Mb</p>
                </div>

            </div>


            <br>
        </div>

        <!-- Dates and Activation Status -->
        <div class="grid lg:grid-cols-4 gap-5">
            <!-- Limit Voting (Min) -->
            <div class="flex flex-col">
                <label for="limit-min" class="mb-1 text-gray-700 font-semibold">Limit Voting (Min)</label>
                <input value="1" name="limit_voting_min" type="number" id="limit-min"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    readonly>
                <p class="text-yellow-600 text-xs">tidak perlu di ubah</p>
            </div>
            <!-- Limit Voting (Max) -->
            <div class="flex flex-col">
                <label for="limit-max" class="mb-1 text-gray-700 font-semibold">Limit Voting (Max)</label>
                <input value="1" name="limit_voting_max" type="number" id="limit-max"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    readonly>
                <p class="text-yellow-600 text-xs">tidak perlu di ubah</p>

            </div>
            <!-- Tanggal Awal -->
            <div class="flex flex-col">
                <label for="tanggal-awal" class="mb-1 text-gray-700 font-semibold">Tanggal Awal</label>
                <input value="{{ $setting->tgl_awal }}" name="tgl_awal" type="date" id="tanggal-awal"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Tanggal Akhir -->
            <div class="flex flex-col">
                <label for="tanggal-akhir" class="mb-1 text-gray-700 font-semibold">Tanggal Akhir</label>
                <input value="{{ $setting->tgl_akhir }}" name="tgl_akhir" type="date" id="tanggal-akhir"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>


        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white font-bold py-2 rounded-md hover:bg-blue-600">Save</button>
    </form>
</div>

<div class="flex justify-center mt-8 h-[full] lg:h-[100vh]">
    <form action="{{ route('admin.store') }}" method="POST"
        class="w-full bg-white p-6 rounded-lg shadow-md space-y-4 px-[10%]">
        @csrf

        <h1 class="text-5xl font-bold">Tambah Data Admin</h1>
        <br><br>

        <div class="lg:flex gap-5 w-full">
            <!-- Nama Lengkap -->
            <div class="flex flex-col lg:w-[40%]">
                <label for="nama-lengkap" class="mb-1 text-gray-700 font-semibold">Nama Lengkap</label>
                <input name="nama_lengkap" type="text" id="nama-lengkap"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan Nama Lengkap" required>
            </div>
            <br>

            <!-- Tanggal Lahir -->
            <div class="flex flex-col lg:w-[30%]">
                <label for="tanggal-lahir" class="mb-1 text-gray-700 font-semibold">Tanggal Lahir</label>
                <input name="tanggal_lahir" type="date" id="tanggal-lahir"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>
            <br>

            <!-- NIK -->
            <div class="flex flex-col lg:w-[30%]">
                <label for="nik" class="mb-1 text-gray-700 font-semibold">NIK</label>
                <input name="nik" type="number" id="nik"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan NIK" required>
            </div>
        </div>
        <br>

        <div class="lg:flex gap-5 w-full">
            <!-- Email -->
            <div class="flex flex-col lg:w-[40%]">
                <label for="email" class="mb-1 text-gray-700 font-semibold">Email</label>
                <input name="email" type="email" id="email"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan Email" required>
            </div>
            <br>

            <!-- Username -->
            <div class="flex flex-col lg:w-[40%]">
                <label for="username" class="mb-1 text-gray-700 font-semibold">Username</label>
                <input name="username" type="text" id="username"
                    class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan Username" required>
            </div>

            <div class="lg:flex gap-5 w-full">
                <!-- Password -->
                <div class="flex flex-col lg:w-[40%]">
                    <label for="password" class="mb-1 text-gray-700 font-semibold">Password</label>
                    <input name="password" type="password" id="password"
                        class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan Password" required>
                </div>
                <br>

                <!-- Confirm Password -->
                <div class="flex flex-col lg:w-[40%]">
                    <label for="password_confirmation" class="mb-1 text-gray-700 font-semibold">Konfirmasi
                        Password</label>
                    <input name="password_confirmation" type="password" id="password_confirmation"
                        class="border border-gray-300 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Konfirmasi Password" required>
                </div>
            </div>


        </div>

        <button type="submit"
            class="w-full bg-blue-500 text-white font-bold py-2 rounded-md hover:bg-blue-600">Tambah Admin</button>
    </form>
</div>



@extends('./templates/Footer')