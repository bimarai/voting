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

        // Paginate the filtered results (8 items per page)
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
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_urut' => 'required|integer|unique:kandidat,nomor_urut',

        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = null;
        }

        Kandidat::create([
            'nama_kandidat' => $request->nama_kandidat,
            'id_setting' => 1, // Set id_setting to 1
            'foto' => $filename,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'alamat' => $request->alamat,
            'nomor_urut' => $request->nomor_urut,
    
        ]);

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
        $request->validate([
            'nama_kandidat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nomor_urut' => 'required|integer|unique:kandidat,nomor_urut,' . $kandidat->id_kandidat . ',id_kandidat',
 
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);

            $data = $request->all();
            $data['foto'] = $filename;
        } else {
            $data = $request->except('foto');
        }

        $data['id_setting'] = 1; // Set id_setting to 1
        $kandidat->update($data);

        return redirect()->route('kandidats.index')->with('success', 'Kandidat updated successfully.');
    }
    // Deleting data
    public function destroy(Kandidat $kandidat)
    {
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
