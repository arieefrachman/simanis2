<?php


namespace App\Repositories;


use App\Models\AlatRuangan;
use App\Models\JadwalInspeksi;
use App\Models\JadwalKalibrasi;
use Illuminate\Support\Facades\DB;

class AlatRuanganRepository implements IRepository
{

    protected AlatRuangan $model;

    public function __construct(AlatRuangan $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->with( 'alat', 'ruangan')->get();
    }

    public function get($id)
    {
        try{
            return $this->model->with('alat')->where('id', $id)->first();
        }catch (\Exception $e){
            throw $e;
        }
    }

    public function store($data)
    {
        try{
            $m = $this->model;
            $m->alat_id = $data['alat_id'];
            $m->ruangan_id = $data['ruangan_id'];
            $m->serial_number = $data['serial_number'];
            $m->keterangan = $data['keterangan'];
            $m->save();
        }catch (\Exception $e){
            throw $e;
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }
    public function createInspection($id){
        try{
            DB::beginTransaction();
            $ar = $this->model->with('alat')->where('id', $id)->first();

            if($ar->last_inspection == null){
                $start_date = date('Y-m-d');
            }else{
                $start_date = $ar->last_inspection;
            }

            if($ar->alat->frek_inspeksi == 'A'){
                $jdw = new JadwalInspeksi();
                $jdw->alat_ruangan_id = $ar->id;
                $jdw->tanggal = date("Y-m-d", strtotime("+1 years", strtotime($start_date)));
                $jdw->checked = false;
                $jdw->save();

                $aru = $this->model->find($id);
                $aru->last_inspection = $start_date;
                $aru->save();
            }else if($ar->alat->frek_inspeksi == 'S'){
                $time = strtotime($start_date);
                for ($i = 0; $i<2; $i++){
                    $final = date("Y-m-d", strtotime("+6 month", $time));
                    $jdw = new JadwalInspeksi();
                    $jdw->alat_ruangan_id = $ar->id;
                    $jdw->tanggal = $final;
                    $jdw->checked = false;
                    $jdw->save();
                    $time = strtotime($final);
                }
                $aru = $this->model->find($id);
                $aru->last_inspection = $final;
                $aru->save();
            }else{
                $time = strtotime($start_date);
                for ($i = 0; $i<4; $i++){
                    $final = date("Y-m-d", strtotime("+3 month", $time));
                    $jdw = new JadwalInspeksi();
                    $jdw->alat_ruangan_id = $ar->id;
                    $jdw->tanggal = $final;
                    $jdw->checked = false;
                    $jdw->save();
                    $time = strtotime($final);
                }
                $aru = $this->model->find($id);
                $aru->last_inspection = $final;
                $aru->save();
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    public function createCalibration($id, $period, $price){
        try{
            DB::beginTransaction();
            $ar = $this->model->with('alat')->where('id', $id)->first();

            if($ar->last_calibration == null){
                $start_date = date('Y-m-d');
            }else{
                $start_date = $ar->last_inspection;
            }

            $jdw = new JadwalKalibrasi();
            $jdw->alat_ruangan_id = $ar->id;
            $jdw->tanggal = date("Y-m-d", strtotime("+".$period." years", strtotime($start_date)));
            $jdw->biaya = str_replace(".", "", $price);
            $jdw->checked = false;
            $jdw->save();

            $aru = $this->model->find($id);
            $aru->last_calibration = $jdw->tanggal;
            $aru->save();

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }


    public function getAlatByRuanganID($id){
        return $this->model->with('alat')->where('ruangan_id', $id)->get();
    }

    public function getRuangan(){
        return $this->model->with('ruangan')->distinct()->get(['ruangan_id']);
    }
}
