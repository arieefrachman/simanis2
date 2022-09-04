<?php


namespace App\Repositories;


use App\Models\Alat;

class AlatRepository implements IRepository
{
    protected $model;

    public function __construct(Alat $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->get();
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
        try{
            $m = $this->model;
            $m->kode = $data['kode'];
            $m->nama = $data['nama_alat'];
            $m->type = $data['type'];
            $m->tahun_pengadaan = $data['thn_pengadaan'];
            $m->harga = str_replace(".", "", $data['harga']);
            $m->usia_teknis = $data['usia_teknis'];
            $m->frek_inspeksi = $data['frek_inspeksi'];
            $m->frek_kalibrasi = $data['frek_kalibrasi'];
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
        try{
            $m = $this->model->find($id);
            $m->kode = $data['kode'];
            $m->nama = $data['nama_alat'];
            $m->type = $data['type'];
            $m->tahun_pengadaan = $data['thn_pengadaan'];
            $m->harga = str_replace(".", "", $data['harga']);
            $m->usia_teknis = $data['usia_teknis'];
            $m->frek_inspeksi = $data['frek_inspeksi'];
            $m->frek_kalibrasi = $data['frek_kalibrasi'];
            $m->save();
        }catch (\Exception $e){
            throw $e;
        }
    }

    public function getAlatLabel(){
        return $this->model->orderBy('nama', 'asc')->orderBy('tahun_pengadaan', 'asc')->get();
    }
}
