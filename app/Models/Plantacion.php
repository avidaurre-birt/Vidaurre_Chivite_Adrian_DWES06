<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plantacion extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fecha',
        'ubicacion',
        'participantes'
    ];



    public function trees(): HasMany
    {
        return $this->hasMany(Tree::class, 'plantacion_id', 'id');
    }
}
