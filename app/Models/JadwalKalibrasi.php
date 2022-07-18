<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKalibrasi extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kalibrasi';
    protected $appends = ['tanggal_formatted', 'concated_serial_alat', 'biaya_formatted'];

    public function alatRuangan(){
        return $this->belongsTo(AlatRuangan::class, 'alat_ruangan_id');
    }

    public function getTanggalFormattedAttribute()
    {
        $date = date_create($this->tanggal);
        return date_format($date, 'd F Y');
    }

    public function getConcatedSerialAlatAttribute(){
        return "(".$this->alatRuangan->serial_number.") ".$this->alatRuangan->alat->nama;
    }

    public function getBiayaFormattedAttribute()
    {
        return "Rp. ".number_format($this->biaya);
    }

    public function hasil(){
        return $this->hasOne(HasilKalibrasi::class, 'jadwal_id');
    }
}
