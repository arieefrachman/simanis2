<?php

namespace App\Http\Controllers;

use App\Repositories\AlatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AlatController extends Controller
{
    protected $repository;

    public function __construct(AlatRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return view('pages.alat.index');
    }

    public function table(){
        try{
            return DataTables::of($this->repository->all())->make(true);
        }catch (\Exception $exception){
            return response()->json($exception, 500);
        }
    }
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'kode' => 'required|numeric',
                'nama_alat' => 'required',
                'thn_pengadaan' => 'required',
            ]);
            if ($validator->fails())
                return response()->json($validator->errors(), 400);

            $this->repository->store($request);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $exception){
            return response()->json($exception, 500);
        }
    }

    public function getRest(){
        try{
            return response()->json($this->repository->getAlatLabel());
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }
}
