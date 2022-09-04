<?php

namespace App\Http\Controllers;

use App\Repositories\KategoriRuanganRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KategoriRuanganController extends Controller
{
    protected KategoriRuanganRepository $repository;

    public function __construct(KategoriRuanganRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return view('pages.kategoriruangan.index');
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'nama_kategori_ruangan' => 'required',
            ]);

            if ($validator->fails())
                return response()->json($validator->errors(), 400);

            $this->repository->store($request);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function updateRest(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_kategori_ruangan' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $this->repository->update($request->id, $request);
        return response()->json(['msg' => 'Success Update'], 200);
    }

    public function show($id){
        try{
            return response()->json($this->repository->get($id));
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    public function getRest(){
        return response()->json($this->repository->all());
    }

    public function table(){
        return DataTables::of($this->repository->all())->addColumn('action', function ($m){
            return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="edit('.$m->id.')"><i class="fas fa-edit"></i></button>';
        })->make(true);
    }
}
