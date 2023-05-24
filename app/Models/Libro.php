<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'Libros';

    protected $fillable = [
        'id',
        'tituloLibro',
        'autor',
        'precio',
    ];
    // use HasFactory;
    public $timestamps = false;
}