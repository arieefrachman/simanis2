<?php


namespace App\Repositories;


use App\Models\AlatRuangan;
use App\Models\HasilKalibrasi;
use App\Models\JadwalKalibrasi;
use Illuminate\Support\Facades\DB;

class HasilKalibrasiRepository implements IRepository
{

    protected $model;

    public function __construct(HasilKalibrasi $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        // TODO: Implement all() method.
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function store($data)
    {
        try{
            DB::beginTransaction();
            $m = $this->model;
            $m->jadwal_id = $data['jadwal_id'];
            $m->hasil = $data['hasil'];
            $m->catatan = $data['catatan'];
            $m->save();

            $jdw = JadwalKalibrasi::find($data['jadwal_id']);
            $jdw->checked = true;
            $jdw->save();

            $ar = AlatRuangan::find($jdw->alat_ruangan_id);
            $ar->status_calibration = $data['hasil'];
            $ar->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
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
}
