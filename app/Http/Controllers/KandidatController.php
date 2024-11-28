<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use App\Models\Pilih;

class KandidatController extends Controller
{
    // Displaying data
    public function index(Request $request)
    {
        // Get search parameters
        $nama_kandidat = $request->input('nama_kandidat');
        $nomor_urut = $request->input('nomor_urut');

        // Build the query for Kandidat model
        $query = Kandidat::orderBy('id_kandidat', 'desc');

        // Apply filters if they exist
        if ($nama_kandidat) {
            $query->where('nama_kandidat', 'like', '%' . $nama_kandidat . '%');
        }

        if ($nomor_urut) {
            $query->where('nomor_urut', $nomor_urut);
        }

        // Paginate the filtered results (5 items per page)
        $kandidats = $query->paginate(5);

        // Query for Pilih model (if needed for displaying choices or options)
        $dtpilih = Pilih::orderBy('nomor_urut', 'asc')->get();

        $name = 'Daftar Kandidat | Admin';

        // Return the view with the filtered and paginated candidates
        return view('kandidats.index', compact('dtpilih', 'kandidats', 'name'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Adding data
    public function create()
    {
        $name = 'Tambah Kandidat | Admin';
        return view('kandidats.create', compact('name'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_urut' => 'required|integer|unique:kandidat,nomor_urut',
        ]);

        // Jika ada foto yang diupload
        if ($request->hasFile('foto')) {
            // Menyimpan foto ke folder storage/app/public/images
            $filename = $request->file('foto')->store('images', 'public');
        } else {
            $filename = null;
        }

        // Simpan data kandidat ke database
        Kandidat::create([
            'nama_kandidat' => $request->nama_kandidat,
            'id_setting' => 1, // Set id_setting ke 1
            'foto' => $filename, // Simpan nama file foto
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'nomor_urut' => $request->nomor_urut,
        ]);

        // Redirect setelah menyimpan data
        return redirect()->route('kandidats.index')->with('success', 'Kandidat created successfully.');
    }

    // Showing details
    public function show(Kandidat $kandidat)
    {
        $name = 'Detail Kandidat | Admin';
        return view('kandidats.show', compact('kandidat', 'name'));
    }

    // Editing data
    public function edit(Kandidat $kandidat)
    {
        $name = 'Edit Kandidat | Admin';
        return view('kandidats.edit', compact('kandidat', 'name'));
    }

    public function update(Request $request, Kandidat $kandidat)
    {
        // Validasi input form
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_urut' => 'required|integer|unique:kandidat,nomor_urut,' . $kandidat->id_kandidat . ',id_kandidat',
        ]);

        // Jika ada foto yang diupload
        if ($request->hasFile('foto')) {
            // Menghapus foto lama jika ada
            if ($kandidat->foto && file_exists(storage_path('app/public/' . $kandidat->foto))) {
                unlink(storage_path('app/public/' . $kandidat->foto));
            }

            // Menyimpan foto yang baru
            $filename = $request->file('foto')->store('images', 'public');
            $data['foto'] = $filename;
        } else {
            $data = $request->except('foto');
        }

        // Menyimpan data kandidat yang telah diperbarui
        $data['id_setting'] = 1; // Set id_setting ke 1
        $kandidat->update($data);

        return redirect()->route('kandidats.index')->with('success', 'Kandidat updated successfully.');
    }

    // Deleting data
    public function destroy(Kandidat $kandidat)
    {
        // Hapus foto jika ada
        if ($kandidat->foto && file_exists(storage_path('app/public/' . $kandidat->foto))) {
            unlink(storage_path('app/public/' . $kandidat->foto));
        }

        // Hapus kandidat dari database
        $kandidat->delete();

        return redirect()->route('kandidats.index')->with('success', 'Kandidat deleted successfully.');
    }

    // Searching
    public function search(Request $request)
    {
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
        ]);

        $pesan = '';
        $cari = Kandidat::where('nama_kandidat', 'LIKE', '%' . $request->nama_kandidat . '%')->get();

        return view('Voting', compact('cari', 'pesan'));
    }
}
