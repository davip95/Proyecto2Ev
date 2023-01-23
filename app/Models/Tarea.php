<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    //use HasFactory;
    protected $table = 'tareas';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'descripcion',
        'correo',
        'direccion',
        'poblacion',
        'codpostal',
        'provincia',
        'estado',
        'fechacreacion',
        'fechafin',
        'anotaantes',
        'anotapost',
        'fichero',
        'clientes_id',
        'users_id',
    ];
    protected $dates = ['fechacreacion', 'fechafin'];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
