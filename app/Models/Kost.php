<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function perhitungan(){
        return $this->belongsTo(Perhitungan::class);
    }
}
