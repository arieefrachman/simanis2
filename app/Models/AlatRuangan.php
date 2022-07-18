<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatRuangan extends Model
{
    use HasFactory;
    protected $table = 'alat_ruangan';
    protected $appends = ['last_inspection_formatted', 'last_calibration_formatted'];

    function alat(){
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    function ruangan(){
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function getLastInspectionFormattedAttribute()
    {
        $date = date_create($this->last_inspection);
        return ($this->last_inspection == null) ? "-": date_format($date, 'd F Y');
    }

    public function getLastCalibrationFormattedAttribute()
    {
        $date = date_create($this->last_calibration);
        return ($this->last_calibration == null) ? "-" : date_format($date, 'd F Y');
    }
}
