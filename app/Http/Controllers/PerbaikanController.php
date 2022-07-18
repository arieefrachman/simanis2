<?php

namespace App\Http\Controllers;

use App\Repositories\RequestPerbaikanRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PerbaikanController extends Controller
{
    protected $repository;

    public function __construct(RequestPerbaikanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return view('pages.perbaikan.index');
    }

    public function table(){
        try{
            return DataTables::of($this->repository->all())->addColumn('status', function ($m){
                if($m->hasil == -1){
                    return '<h5><span class="badge badge-danger">Rusak</span></h5>';
                }else{
                    return '<h5><span class="badge badge-success">Baik</span></h5>';
                }
            })->addColumn('action', function ($m){
                if($m->hasil == -1){
                    return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Perbaikan" onclick="showFormfix('.$m->id.')"><i class="fas fa-hammer"></i></button>';
                }
            })->rawColumns(['status', 'action'])->make(true);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'tgl_kerusakan' => 'required',
                'alat_id' => 'required',
            ]);

            if ($validator->fails())
                return response()->json($validator->errors(), 400);

            $this->repository->store($request);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $e){
            if($e instanceof ModelNotFoundException){
                return response()->json(["msg" => $e->getMessage()], 500);
            }else{
                return response()->json(["msg" => $e->getMessage()], 500);
            }
        }
    }

    public function show($id){
        try{
            return response()->json($this->repository->get($id));
        }catch (\Exception $e){
            return response()->json(["msg" => $e->getMessage()], 500);
        }
    }

    public function simpanPerbaikan(Request $request, $id){
        try{
            $validator = Validator::make($request->all(), [
                'biaya' => 'required',
                'tgl_perbaikan' => 'required',
            ]);

            if ($validator->fails())
                return response()->json($validator->errors(), 400);

            $this->repository->update($id, $request);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $e){
            return response()->json(["msg" => $e->getMessage()], 500);
        }
    }
}
