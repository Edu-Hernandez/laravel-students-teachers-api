<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Nombre de la tabla relacionada con el modelo
    protected $table = 'student';

    // Campos que pueden ser alterados
    protected $fillable = [
        'name',
        'email',
        'phone',
        'languaje' // Cambiado a 'languaje'
    ];
}

