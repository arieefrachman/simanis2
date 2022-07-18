<?php

namespace App\Http\Controllers;

use App\Repositories\ReportRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    protected $repository;

    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
    }

    public function tableKerusakan(){
        return DataTables::of($this->repository->reportKerusakanAlat())->addColumn('status_alat_label', function ($q){
            if($q->status_alat == -1){
                return '<h5><span class="badge badge-danger">Rusak</span></h5>';
            }else{
                return '<h5><span class="badge badge-success">Baik</span></h5>';
            }
        })->rawColumns(['status_alat_label'])->make(true);
    }

    public function tableKalibrasi(){
        return DataTables::of($this->repository->reportKalibrasi())->addColumn('biaya_kalibrasi_label', function ($q){
            if($q->biaya_kalibrasi == null){
                return '<h5><span class="badge badge-secondary">Belum dijadwalkan kalibrasi</span></h5>';
            }else{
                return $q->biaya_kalibrasi;
            }
        })->rawColumns(['biaya_kalibrasi_label'])->make(true);
    }

    public function reportKerusakan(){
        return view('pages.report.report_kerusakan');
    }

    public function reportKalibrasi(){
        return view('pages.report.report_kalibrasi');
    }
}
