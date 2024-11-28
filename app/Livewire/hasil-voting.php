<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PemilihanDetail;
use App\Models\Kandidat;
use Illuminate\Support\Facades\DB;

class HasilVoting extends Component
{
    public $hasilVoting;
    public $totalSuara;
    public $totalKandidat;

    public function mount()
    {
        $this->updateData();
    }

    public function updateData()
    {
        $this->totalSuara = PemilihanDetail::count();
        $this->totalKandidat = Kandidat::count();

        $this->hasilVoting = PemilihanDetail::select(
            'pemilihan_detail.id_kandidat',
            'kandidat.nama_kandidat',
            'kandidat.nomor_urut',
            DB::raw('COUNT(*) as total_suara')
        )
            ->join('kandidat', 'pemilihan_detail.id_kandidat', '=', 'kandidat.id_kandidat')
            ->groupBy('pemilihan_detail.id_kandidat', 'kandidat.nama_kandidat', 'kandidat.nomor_urut')
            ->orderBy('kandidat.nomor_urut')
            ->get();
    }

    public function render()
    {
        return view('livewire.hasil-voting', [
            'hasilVoting' => $this->hasilVoting,
            'totalSuara' => $this->totalSuara,
            'totalKandidat' => $this->totalKandidat,
        ]);
    }
}