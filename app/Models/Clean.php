<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clean extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'ubicacion',
        'fecha',
        'cantidadRecogida_Kg',
        'participantes',
        'descripcion'
    ];
}
