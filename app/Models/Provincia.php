<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //use HasFactory;
    protected $table = 'tbl_provincias';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'cod';
    public $timestamps = false;
}
