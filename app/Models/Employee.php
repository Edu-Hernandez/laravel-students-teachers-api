<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    // Nombre de la tabla relacionada con el modelo
    protected $table = 'employee';

    // Campos que pueden ser alterados
    protected $fillable = [
        'name',
        'apellido',
        'area',
        'turno' // Cambiado a 'languaje'
    ];
}
