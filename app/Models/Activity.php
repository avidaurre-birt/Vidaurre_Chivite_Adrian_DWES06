<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'fecha',
        'ubicacion',
        'duracion',
        'descripcion',
        'publico'
    ];
}
