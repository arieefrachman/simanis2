<?php


namespace App\Repositories;


use App\Models\Alat;
use App\Models\AlatRuangan;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class AlatRepository implements IRepository
{
    protected $model;
    protected $modelAlatRuangan;

    public function __construct(Alat $model, AlatRuangan $modelAlatRuangan)
    {
        $this->model = $model;
        $this->modelAlatRuangan = $modelAlatRuangan;
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
        try {
            $m = $this->model->find($id);

            if($this->modelAlatRuangan->where('alat_id', $m->id)->exists()){
                throw new ConflictHttpException('');
            }
            $m->delete();
        }catch (\Exception $e){
            throw $e;
        }
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
