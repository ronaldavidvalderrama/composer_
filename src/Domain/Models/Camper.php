<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Camper extends Model 
{
    protected $table = 'campers'; // Nombre de la tablaa
    protected $primaryKey = 'id'; // llave primaria 
    public $timestamps = true; // habilita el uso del create_at
    protected $fillable = ['nombre', 'edad', 'documento', 'tipo_documento', 'nivel_ingles', 'nivel_programacion',]; // columnas habilitadas para la insersion

}