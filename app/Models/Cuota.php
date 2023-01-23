<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    //use HasFactory;
    protected $table = 'cuotas';
    public $timestamps = false;

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
}
