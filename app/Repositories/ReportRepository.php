<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function reportKerusakanAlat(){
        $query = DB::select("select a.nama alat,
        ar.serial_number,
       case when rf.hasil = -1 then -1 else 1 end status_alat,
       r.nama ruangan,
       a.usia_teknis * 8760 usia_teknis,
       (DATE_PART('year', rf.tanggal_kerusakan)-a.tahun_pengadaan)* 8760 usia_pakai,
       (a.usia_teknis * 8760) - ((DATE_PART('year', rf.tanggal_kerusakan)-a.tahun_pengadaan)* 8760) usia_manfaat,
       (((a.usia_teknis * 8760) - ((DATE_PART('year', rf.tanggal_kerusakan)-a.tahun_pengadaan)* 8760) )/(a.usia_teknis * 8760) ) *100::float8 persen_manfaat,
       'Rp. '||to_char((((0.9) * (((a.usia_teknis * 8760) - ((DATE_PART('year', rf.tanggal_kerusakan)-a.tahun_pengadaan)* 8760) )/(a.usia_teknis * 8760) ))::float8)*a.harga, '999,999,999,999,999') mmel,
       'Rp. '||to_char(rf.biaya, '999,999,999,999,999') biaya_perbaikan,
       a.tahun_pengadaan,
       a.type,
       to_char(rf.tanggal_kerusakan, 'DD Month YYYY') tanggal_kerusakan,
       to_char(rf.tanggal_perbaikan, 'DD Month YYYY') tanggal_perbaikan
from alat_ruangan ar
         join ruangan r on ar.ruangan_id = r.id
         join alat a on ar.alat_id = a.id left outer join request_perbaikan rf on rf.alat_ruangan_id = ar.id");

        return $query;
    }

    public function reportKalibrasi(){
        $query = DB::select("select a.nama alat, ar.serial_number, r.nama ruangan, 'Rp. '||to_char(sum(jk.biaya), '999,999,999,999,999') biaya_kalibrasi
from alat_ruangan ar
    join alat a on ar.alat_id = a.id and a.frek_kalibrasi != 0
    join ruangan r on ar.ruangan_id = r.id
    left outer join jadwal_kalibrasi jk on ar.id = jk.alat_ruangan_id
group by a.nama, ar.serial_number, r.nama
order by 4;");

        return $query;
    }
}
