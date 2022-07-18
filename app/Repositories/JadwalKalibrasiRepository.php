<?php


namespace App\Repositories;


use App\Models\JadwalKalibrasi;

class JadwalKalibrasiRepository implements IRepository
{

    protected JadwalKalibrasi $model;

    public function __construct(JadwalKalibrasi $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->with('alatRuangan', 'alatRuangan.alat', 'alatRuangan.ruangan', 'hasil')->get();
    }

    public function get($id)
    {
        return $this->model->with('alatRuangan', 'alatRuangan.alat')->where('id', $id)->first();
    }

    public function store($data)
    {
        // TODO: Implement store() method.
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
