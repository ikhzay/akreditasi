<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $table = 'ak_kriteria';

    public function instrument(){
        return $this->hasMany(Instrument::class);
    }
}
