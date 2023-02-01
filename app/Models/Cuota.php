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
    public $timestamps = false;

    public function clientes()
    {
        return $this->belongsTo(Cliente::class);
    }
}
