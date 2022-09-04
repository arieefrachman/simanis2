<?php

namespace App\Http\Controllers;

use App\Repositories\AlatRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
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
            return DataTables::of($this->repository->all())
                ->addColumn('action', function ($m){
                    return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="edit('.$m->id.')"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="hapus('.$m->id.')"><i class="fas fa-trash"></i></button>';
                })->addColumn('frek_inspeksi', function ($m){
                    switch ($m->frek_inspeksi){
                        case 'A':
                            return 'Annual';
                            break;
                        case 'S':
                            return 'Semi-annual';
                            break;
                        case 'T':
                            return 'Three-yearly';
                            break;

                    }
                })->addColumn('frek_kalibrasi', function ($m){
                    return $m->frek_kalibrasi.' Tahun';
                })->addColumn('usia_teknis', function ($m){
                    return $m->usia_teknis.' Tahun';
                })->make(true);
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

    public function show($id){
        try{
            return response()->json($this->repository->get($id));
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    public function updateRest(Request $request){
        $validator = Validator::make($request->all(), [
            'kode' => 'required|numeric',
            'nama_alat' => 'required',
            'thn_pengadaan' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        $this->repository->update($request->id, $request);
        return response()->json(['msg' => 'Success Update'], 200);
    }

    public function getRest(){
        try{
            return response()->json($this->repository->getAlatLabel());
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function deleteRest($id){
        try{
            $this->repository->delete($id);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $e){
            if ($e instanceof ConflictHttpException){
                return response()->json(['message' => 'Data alat sudah terasosiasi dengan data alat-ruangan dan tidak dapat dihapus'], 409);
            }
            return response()->json(['message' => $e], 500);
        }
    }
}
