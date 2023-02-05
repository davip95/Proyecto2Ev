<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuota extends Model
{
    //use HasFactory;
    use SoftDeletes;
    protected $table = 'cuotas';
    protected $fillable = [
        'concepto',
        'fechaemision',
        'importe',
        'pagada',
        'fechapago',
        'notas',
        'clientes_id'
    ];
    public $timestamps = false;
    protected $dates = ['fechaemision', 'fechapago'];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
}
