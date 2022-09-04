<?php


namespace App\Repositories;


use App\Models\Ruangan;

class RuanganRepository implements IRepository
{

    protected $model;

    public function __construct(Ruangan $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('kategori')->get();
    }

    public function get($id)
    {
        try{
            return $this->model->where('id', $id)->first();
        }catch (\Exception $e){
            throw $e;
        }

    }

    public function store($data)
    {
        try {
            $m = $this->model;
            $m->nama = $data['nama_ruangan'];
            $m->pic = $data['pic'];
            $m->kategori_ruangan_id = $data['ruangan_kategori_id'];
            $m->alias = $data['alias'];
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
        try {
            $m = $this->model->find($id);
            $m->nama = $data['nama_ruangan'];
            $m->pic = $data['pic'];
            $m->kategori_ruangan_id = $data['ruangan_kategori_id'];
            $m->alias = $data['alias'];
            $m->keterangan = $data['keterangan'];
            $m->save();
        }catch (\Exception $e){
            throw $e;
        }
    }
}
