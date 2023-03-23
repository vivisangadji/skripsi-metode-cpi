<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kost(){
        return $this->belongsTo(Kost::class, 'id_kost');
    }
}
