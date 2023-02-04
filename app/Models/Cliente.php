<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    //use HasFactory;
    use SoftDeletes;
    protected $table = 'clientes';
    protected $fillable = [
        'cif',
        'nombre',
        'telefono',
        'correo',
        'cuentacorriente',
        'pais',
        'moneda',
        'importemensual'
    ];
    public $timestamps = false;

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function cuotas()
    {
        return $this->hasMany(Cuota::class);
    }
}
