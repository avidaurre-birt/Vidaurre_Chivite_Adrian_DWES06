<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tree extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'especie',
        'cantidad'
    ];


    public function plantacion(): BelongsTo
    {
        return $this->belongsTo(Plantacion::class, 'plantacion_id', 'id');
    }
}
