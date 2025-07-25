<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model 
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id'; // llave primaria 
    public $timestamps = true; // habilita el uso del create_at
    protected $fillable = ['nombre', 'email' , 'password', 'rol']; // columnas habilitadas para la insersion
    protected $hidden = ['password'];

}