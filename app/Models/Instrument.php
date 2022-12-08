<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $table = 'ak_instrument';
    protected $with = ['penilaian'];

    public function penilaian(){
        return $this->hasMany(Penilaian::class);
    }

    public function kriteria(){
        return $this->belongsTo(Kriteria::class);
    }
}
