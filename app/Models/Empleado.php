<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Sucursal;

class Empleado extends Model
{
    protected $fillable = [
    	'id','documento','nombres','apellidos','id_sucursal'
    ];
    public $timestamps = false;

    public function sucursal () {
    	return $this->belongsTo(Sucursal::class,'id_sucursal');
    }
}
