<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'autor',
        'editorial',
        'categoria_id',
        'foto',
    ];
    public function categorias()
    {
        return $this->hasOne(Categorias::class, 'id', 'categoria_id');
    }
}
