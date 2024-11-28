<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;
use App\Models\Pilih;
use App\Models\PemilihanDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Login;

class PilihController extends Controller
{
    public function index(Request $request)
    {
        $nama_kandidat = $request->input('nama_kandidat');
        $nomor_urut = $request->input('nomor_urut');

        $query = Kandidat::orderBy('nomor_urut', 'asc');

        if ($nama_kandidat) {
            $query->where('nama_kandidat', 'like', '%' . $nama_kandidat . '%');
        }

        if ($nomor_urut) {
            $query->where('nomor_urut', $nomor_urut);
        }

        $dtpilih = $query->get();
        $name = 'Halaman Voting';
        $pesan = '';

        // Cek apakah token sudah digunakan atau belum
        $token = session()->get('user_token');
        $login = Login::where('token', $token)->first();

        // Pastikan token status sesuai: 1 berarti aktif dan belum digunakan, 0 berarti sudah digunakan
        $tokenStatus = $login ? $login->is_pakai : 1; // default ke 1 jika token tidak ditemukan

        return view('Voting', compact('dtpilih', 'name', 'pesan', 'tokenStatus'));
    }

    public function store($id_kandidat)
    {
        $token = session()->get('user_token');

        // Cek apakah token masih bisa digunakan untuk memilih (is_pakai bernilai 1 berarti belum digunakan)
        $login = Login::where('token', $token)->first();

        if (!$login || $login->is_pakai == 0) {
            // Token tidak ditemukan atau sudah dipakai
            return redirect()->route('home.index')->with('error', 'Token Anda sudah digunakan atau tidak valid untuk memilih.');
        }

        // Menyimpan suara ke PemilihanDetail
        PemilihanDetail::create([
            'id_kandidat' => $id_kandidat,
            'id_pemilihan' => 1, // Anda bisa menyesuaikan dengan id pemilihan yang aktif
        ]);

        // Tandai token sebagai sudah digunakan (is_pakai = 0)
        Login::where('token', $token)->update(['is_pakai' => 0]);

        return redirect()->route('Thanks')->with('success', 'Terima kasih telah memilih!');
    }

    // menghitung jumlah data kandidat menggunakan livewire
    public function hasilVoting()
    {
        $totalSuara = PemilihanDetail::count();
        $totalKandidat = Kandidat::count();
        $name = 'Hasil Pemilihan | Admin';

        $hasilVoting = PemilihanDetail::select(
            'pemilihan_detail.id_kandidat',
            'kandidat.nama_kandidat',
            'kandidat.nomor_urut',
            DB::raw('COUNT(*) as total_suara')
        )
            ->join('kandidat', 'pemilihan_detail.id_kandidat', '=', 'kandidat.id_kandidat')
            ->groupBy('pemilihan_detail.id_kandidat', 'kandidat.nama_kandidat', 'kandidat.nomor_urut')
            ->orderBy('kandidat.nomor_urut')
            ->get();

        return view('Hasil', compact('hasilVoting', 'name', 'totalSuara', 'totalKandidat'));
    }

    public function hapusSemuaData()
    {
        // Menghapus semua data di tabel pemilihan_detail
        PemilihanDetail::truncate();

        return redirect()->route('hasil.voting')->with('pesan', 'Semua data pemilihan telah dihapus.');
    }
}
