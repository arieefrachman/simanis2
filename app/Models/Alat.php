<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;
    protected $table = 'alat';
    protected $appends = ['harga_formatted', 'alat_label_ref'];

    public function getHargaFormattedAttribute()
    {
        return "Rp. ".number_format($this->harga);
    }

    public function getAlatLabelRefAttribute(){
        return $this->kode."/".$this->nama."/".$this->tahun_pengadaan."/".$this->type;
    }
}
