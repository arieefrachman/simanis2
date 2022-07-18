<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestPerbaikan extends Model
{
    use HasFactory;
    protected $table = 'request_perbaikan';

    protected $appends = ['tgl_kerusakan'];

    public function alatRuangan(){
        return $this->belongsTo(AlatRuangan::class);
    }

    public function getTglKerusakanAttribute()
    {
        $date = date_create($this->tanggal_kerusakan);
        return date_format($date, 'd F Y');
    }
}
