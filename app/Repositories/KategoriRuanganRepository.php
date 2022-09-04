<?php


namespace App\Repositories;


use App\Models\KategoriRuangan;
use App\Models\Ruangan;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class KategoriRuanganRepository implements IRepository
{

    protected $model;
    protected $modelRuangan;

    public function __construct(KategoriRuangan $model, Ruangan $modelRuangan)
    {
        $this->model = $model;
        $this->modelRuangan = $modelRuangan;
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
        try {
            $m = $this->model->find($id);

            if($this->modelRuangan->where('kategori_ruangan_id', $m->id)->exists()){
                throw new ConflictHttpException('');
            }
            $m->delete();
        }catch (\Exception $e){
            throw $e;
        }
    }

    public function update($id, $data)
    {
        try {
            $m = $this->model->find($id);
            $m->nama = $data['nama_kategori_ruangan'];
            $m->alias = $data['alias'];
            $m->save();
        }catch (\Exception $e){
            throw $e;
        }
    }
}
