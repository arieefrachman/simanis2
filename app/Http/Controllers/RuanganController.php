<?php

namespace App\Http\Controllers;

use App\Repositories\RuanganRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RuanganController extends Controller
{
    protected RuanganRepository $repository;

    public function __construct(RuanganRepository $ruanganRepository)
    {
        $this->repository = $ruanganRepository;
    }

    public function index(){
        return view('pages.ruangan.index');
    }

    public function table(){
        return DataTables::of($this->repository->all())->addColumn('action', function ($m){
            return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="edit('.$m->id.')"><i class="fas fa-edit"></i></button>';
        })
            ->make(true);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_ruangan' => 'required',
            'ruangan_kategori_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $this->repository->store($request);
        return response()->json(['msg' => 'Success'], 200);
    }

    public function updateRest(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_ruangan' => 'required',
            'ruangan_kategori_id' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $this->repository->update($request->id_ruangan, $request);
        return response()->json(['msg' => 'Success Update'], 200);
    }


    public function getRest(){
        try{
            return response()->json($this->repository->all());
        }catch (\Exception $exception){
            return response()->json($exception, 500);
        }
    }

    public function show($id){
        try{
            return response()->json($this->repository->get($id));
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }
}
