<?php


namespace App\Repositories;


use App\Models\KategoriRuangan;

class KategoriRuanganRepository implements IRepository
{

    protected $model;

    public function __construct(KategoriRuangan $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function store($data)
    {
        try {
            $m = $this->model;
            $m->nama = $data['nama_kategori_ruangan'];
            $m->alias = $data['alias'];
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
}
