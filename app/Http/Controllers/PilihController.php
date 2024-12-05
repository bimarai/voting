<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\PemilihanDetail;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PilihController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Kandidat::orderBy('nomor_urut', 'asc');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_kandidat', 'like', '%' . $search . '%')
                  ->orWhere('nomor_urut', 'like', '%' . $search . '%');
            });
        }
    
        $dtpilih = $query->paginate(5); // Gunakan pagination jika data banyak
        $name = 'Halaman Voting';
    
        $token = session()->get('user_token');
        $login = Login::where('token', $token)->first();
        $tokenStatus = $login ? $login->is_pakai : 1;
    
        return view('Voting', compact('dtpilih', 'name', 'tokenStatus'));
    }

    public function store($id_kandidat)
    {
        $token = session()->get('user_token');
        $login = Login::where('token', $token)->first();
        
        if (!$login || $login->is_pakai == 0) {
            return redirect()->route('home.index')->with('error', 'Token Anda sudah digunakan atau tidak valid untuk memilih.');
        }

        PemilihanDetail::create([
            'id_kandidat' => $id_kandidat,
            'id_pemilihan' => 1,
        ]);

        Login::where('token', $token)->update(['is_pakai' => 0]);

        return redirect()->route('Thanks')->with('success', 'Terima kasih telah memilih!');
    }

    public function hasilVoting(Request $request)
    {
        $name = 'Hasil Pemilihan | Admin';
        $totalSuara = PemilihanDetail::count();
        $totalKandidat = Kandidat::count();
    
        // Apply pagination on the query
        $hasilVoting = PemilihanDetail::select(
            'pemilihan_detail.id_kandidat',
            'kandidat.nama_kandidat',
            'kandidat.nomor_urut',
            'kandidat.foto',
            DB::raw('COUNT(pemilihan_detail.id_kandidat) as total_suara')
        )
        ->join('kandidat', 'pemilihan_detail.id_kandidat', '=', 'kandidat.id_kandidat')
        ->groupBy('pemilihan_detail.id_kandidat', 'kandidat.nama_kandidat', 'kandidat.nomor_urut', 'kandidat.foto')
        ->orderByDesc('total_suara')
        ->paginate(5); // Paginate results with 5 items per page
    
        return view('Hasil', compact('hasilVoting', 'name', 'totalSuara', 'totalKandidat'));
    }
    

    public function hapusSemuaData()
    {
        PemilihanDetail::truncate();
        return redirect()->route('hasil.voting')->with('pesan', 'Semua data pemilihan telah dihapus.');
    }
}
