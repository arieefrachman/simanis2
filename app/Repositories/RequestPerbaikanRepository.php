<?php


namespace App\Repositories;


use App\Models\RequestPerbaikan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RequestPerbaikanRepository implements IRepository
{
    protected RequestPerbaikan $model;

    public function __construct(RequestPerbaikan $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('alatRuangan', 'alatRuangan.alat', 'alatRuangan.ruangan')->get();
    }

    public function get($id)
    {
        return $this->model->with('alatRuangan', 'alatRuangan.alat', 'alatRuangan.ruangan')->find($id);
    }

    public function store($data)
    {
        try{
            $ex = $this->model->where(['alat_ruangan_id' => $data['alat_id'], 'hasil' => -1])->exists();

            if($ex){
                throw new ModelNotFoundException("Alat masih belum diperbaiki, harap diperbaiki terlebih dahulu!");
            }

            $m = $this->model;
            $m->alat_ruangan_id = $data['alat_id'];
            $m->hasil = -1;
            $m->tanggal_kerusakan = $data['tgl_kerusakan'];
            $m->catatan = $data['catatan'];
            $m->save();
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id, $data)
    {
        try{
            $m = $this->model->find($id);
            $m->tanggal_perbaikan = $data['tgl_perbaikan'];
            $m->hasil = $data['hasil'];
            $m->catatan_perbaikan = $data['catatan_perbaikan'];
            $m->biaya =  str_replace(".", "", $data['biaya']);
            $m->save();
        }catch (\Exception $e){
            throw  $e;
        }
    }
}
