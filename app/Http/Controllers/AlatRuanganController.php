<?php

namespace App\Http\Controllers;

use App\Repositories\AlatRuanganRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AlatRuanganController extends Controller
{
    protected AlatRuanganRepository $repository;

    public function __construct(AlatRuanganRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return view('pages.alatruangan.index');
    }

    public function table(){
        return DataTables::of($this->repository->all())->addColumn('action', function ($m){
            if($m->alat->frek_kalibrasi != 0){
                return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detail('.$m->id.')"><i class="fas fa-list-ul"></i></button>
                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Buat jadwal kalibrasi" onclick="calibrate('.$m->id.')"><i class="fas fa-cogs"></i></button>
                    <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Buat jadwal inspeksi" onclick="inspection('.$m->id.')"><i class="fas fa-binoculars"></i></button>';
            }else{
                return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detail('.$m->id.')"><i class="fas fa-list-ul"></i></button>
                    <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Buat jadwal inspeksi" onclick="inspection('.$m->id.')"><i class="fas fa-binoculars"></i></button>';
            }
        })->addColumn('status_kalibrasi', function ($m){
            if($m->alat->frek_kalibrasi != 0){
                if($m->status_calibration == 0){
                    return '<h5><span class="badge badge-warning">Belum Dievaluasi</span></h5>';
                }else if ($m->status_calibration > 0){
                    return '<h5><span class="badge badge-primary">Laik</span></h5>';
                }else{
                    return '<h5><span class="badge badge-danger">Tidak Laik</span></h5>';
                }
            }else{
                return '<h5><span class="badge badge-secondary">Alat tidak Dikalibrasi</span></h5>';
            }
        })->addColumn('status_inspeksi', function ($m){
            if($m->status_inspection == 0){
                return '<h5><span class="badge badge-warning">Belum Dievaluasi</span></h5>';
            }else if ($m->status_inspection > 0){
                return '<h5><span class="badge badge-primary">Baik</span></h5>';
            }else{
                return '<h5><span class="badge badge-danger">Tidak Baik</span></h5>';
            }
        })->rawColumns(['action', 'status_kalibrasi', 'status_inspeksi'])->make(true);
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'alat_id' => 'required',
                'ruangan_id' => 'required',
                'serial_number' => 'required|unique:alat_ruangan',
            ]);

            if ($validator->fails())
                return response()->json($validator->errors(), 400);

            $this->repository->store($request);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    public function show($id){
        try{
            return response()->json($this->repository->get($id));
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    public function createInspection($id){
        try{
            $this->repository->createInspection($id);
            return response()->json(['msg' => 'success']);
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    public function createCalibration(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'harga' => 'required',
            ]);

            if ($validator->fails())
                return response()->json($validator->errors(), 400);

            $this->repository->createCalibration($request->input('alat_ruangan_id'), $request->input('frek_kalibrasi_val'), $request->input('harga'));
            return response()->json(['msg' => 'success']);
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }

    public function alat($id){
        try{
            return response()->json($this->repository->getAlatByRuanganID($id));
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }
    public function ruangan(){
        try{
            return response()->json($this->repository->getRuangan());
        }catch (\Exception $e){
            return response()->json(['message' => $e], 500);
        }
    }
}
