<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalInspeksi extends Model
{
    use HasFactory;
    protected $table = 'jadwal_inspeksi';

    protected $appends = ['tanggal_formatted', 'concated_serial_alat'];

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

    public function hasil(){
        return $this->hasOne(HasilInspeksi::class, 'jadwal_id');
    }
}
