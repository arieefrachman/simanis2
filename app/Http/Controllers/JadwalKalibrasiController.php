<?php

namespace App\Http\Controllers;

use App\Repositories\HasilKalibrasiRepository;
use App\Repositories\JadwalKalibrasiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JadwalKalibrasiController extends Controller
{
    protected JadwalKalibrasiRepository $repository;
    protected HasilKalibrasiRepository $hasilKalibrasiRepository;

    public function __construct(JadwalKalibrasiRepository $repository, HasilKalibrasiRepository $hasilKalibrasiRepository)
    {
        $this->repository = $repository;
        $this->hasilKalibrasiRepository = $hasilKalibrasiRepository;
    }
    public function index(){
        return view('pages.kalibrasi.index');
    }

    public function table(){
        return DataTables::of($this->repository->all())
            ->addColumn('action', function ($m){
                if(!$m->checked){
                    return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Check Kalibrasi" onclick="checkKalibrasiForm('.$m->id.')"><i class="fas fa-print"></i></button>';
                }else{
                    return '';
                }
            })->addColumn('status', function ($m) {
                if($m->hasil == null){
                    return '<h5><span class="badge badge-secondary">Belum dievaluasi</span></h5>';
                }else{
                    if($m->hasil->hasil == 1){
                        return '<h5><span class="badge badge-success">Laik</span></h5>';
                    }else{
                        return '<h5><span class="badge badge-danger">Tidak Laik</span></h5>';
                    }
                }
            })->rawColumns(['action', 'status'])->make(true);;
    }

    public function show($id){
        try{
            return response()->json($this->repository->get($id));
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function createHasil(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'jadwal_id' => 'required',
                'hasil' => 'required',
                'catatan' => 'required'
            ]);

            if ($validator->fails())
                return response()->json($validator->errors(), 400);

            $this->hasilKalibrasiRepository->store($request);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }
}
