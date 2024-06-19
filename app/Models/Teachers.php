<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    //definición de nombre de la tabla relacionada con el modelo
    protected $table = 'teachers';

    // nuestros campos que pueden ser alterados
    protected $fillable = [ 'name', 'lastname','dni','phone','cargo'];
}
