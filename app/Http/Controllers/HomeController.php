<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected DashboardRepository $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {
        return view('dashboard');
    }

    public function totalAlat(){
        try{
            return response()->json(['value' => $this->dashboardRepository->getTotalAlat()]);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function totalBaik(){
        try{
            return response()->json(['value' => $this->dashboardRepository->getTotalBaik()]);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function totalRusak(){
        try{
            return response()->json(['value' => $this->dashboardRepository->getTotalRusak()]);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function totalWajibKalibrasi(){
        try{
            return response()->json(['value' => $this->dashboardRepository->getTotaWajibKalibrasi()]);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function inspectionActivity(){
        try{
            return response()->json([
                'total' => $this->dashboardRepository->getTotalAlat(),
                'eval' => $this->dashboardRepository->getTotalEvalInspection(),
                'good' => $this->dashboardRepository->getTotalBaik(),
                'bad' => $this->dashboardRepository->getTotalRusak()
            ]);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function calibrationActivity(){
        try{
            return response()->json([
                'total' => $this->dashboardRepository->getTotalAlatKalibrasi(),
                'eval' => $this->dashboardRepository->getTotaWajibKalibrasi(),
                'good' => $this->dashboardRepository->getTotalLaik(),
                'bad' => $this->dashboardRepository->getTotalTidakLaik()
            ]);
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function totalAlatInspeksi(){
        try{
            return response()->json($this->dashboardRepository->getTotalInspeksi());
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function totalAlatKalibrasi(){
        try{
            return response()->json($this->dashboardRepository->getTotalKalibrasi());
        }catch (\Exception $e){
            return response()->json($e, 500);
        }
    }

    public function test(){
        /*$time = strtotime("2019-12-08");
        for ($i = 0; $i<4; $i++){
            $final = date("Y-m-d", strtotime("+3 month", $time));
            $time = strtotime($final);
            echo $final."</br>";
        }*/

        echo date('Y-m-d');

    }
}
