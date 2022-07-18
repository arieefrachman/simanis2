<?php

namespace App\Http\Controllers;

use App\Models\HasilInspeksi;
use App\Models\JadwalInspeksi;
use App\Repositories\HasilInspeksiRepository;
use App\Repositories\JadwalInspeksiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JadwalInspeksiController extends Controller
{
    protected JadwalInspeksiRepository $repository;
    protected HasilInspeksiRepository $hasilInspeksiRepository;

    public function __construct(JadwalInspeksiRepository $repository, HasilInspeksiRepository $hasilInspeksiRepository)
    {
        $this->repository = $repository;
        $this->hasilInspeksiRepository = $hasilInspeksiRepository;
    }

    public function index(){
        return view('pages.inspeksi.index');
    }

    public function table(){
        return DataTables::of($this->repository->all())->addColumn('action', function ($m){
            if(!$m->checked){
                return '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Check Inspeksi" onclick="checkInspeksiForm('.$m->id.')"><i class="fas fa-print"></i></button>';
            }else{
                return '';
            }
        })->addColumn('status', function ($m) {
            if($m->hasil == null){
                return '<h5><span class="badge badge-secondary">Belum dievaluasi</span></h5>';
            }else{
                if($m->hasil->hasil == 1){
                    return '<h5><span class="badge badge-success">Baik</span></h5>';
                }else{
                    return '<h5><span class="badge badge-danger">Rusak</span></h5>';
                }
            }
        })->rawColumns(['action', 'status'])->make(true);
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

            $this->hasilInspeksiRepository->store($request);
            return response()->json(['msg' => 'Success'], 200);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }
}
