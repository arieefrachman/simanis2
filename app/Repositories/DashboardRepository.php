<?php


namespace App\Repositories;


use App\Models\AlatRuangan;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    protected AlatRuangan $modelAlatRuangan;

    public function __construct(AlatRuangan $modelAlatRuangan)
    {
        $this->modelAlatRuangan = $modelAlatRuangan;
    }

    public function getTotalAlat(){
        return $this->modelAlatRuangan->count();
    }

    public function getTotalEvalInspection(){
        return $this->modelAlatRuangan->where('status_inspection', 0)->count();
    }

    public function getTotalBaik(){
        return $this->modelAlatRuangan->where('status_inspection', 1)->count();
    }

    public function getTotalRusak(){
        return $this->modelAlatRuangan->where('status_inspection', -1)->count();
    }

    public function getTotalAlatKalibrasi(){
        return DB::table('alat_ruangan')
            ->join('alat', 'alat_ruangan.alat_id', '=', 'alat.id')->where('frek_kalibrasi', '!=', 0)
            ->count();
    }

    public function getTotalLaik(){
        return $this->modelAlatRuangan->where('status_calibration', 1)->count();
    }

    public function getTotalTidakLaik(){
        return $this->modelAlatRuangan->where('status_calibration', -1)->count();
    }

    public function getTotaWajibKalibrasi(){
        return DB::table('alat_ruangan')
            ->join('alat', 'alat_ruangan.alat_id', '=', 'alat.id')->where('frek_kalibrasi', '!=', 0)->where('status_calibration', '=', 0)
            ->count();
    }

    public function getTotalInspeksi() {
        return DB::select("select case when a.frek_inspeksi = 'A' then 'Annual' when a.frek_inspeksi = 'S' then 'Semi-annual' else 'Three-yearly' end frek_inspeksi, count(*) from alat a join alat_ruangan ar on a.id = ar.alat_id group by a.frek_inspeksi");
    }

    public function getTotalKalibrasi(){
        return DB::select("select case when frek_kalibrasi::varchar = '0' then 'Tidak Kalibrasi' else frek_kalibrasi::varchar || ' tahun' end frek_kalibrasi, count(*) from alat a join alat_ruangan ar on a.id = ar.alat_id group by a.frek_kalibrasi");
    }
}
