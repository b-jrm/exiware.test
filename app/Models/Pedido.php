<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Sucursal;

class Pedido extends Model
{
    protected $fillable = [
    	'id','id_empleado','id_cliente','id_sucursal'
    ];
    public $timestamps = false;

    function empleado () {
    	return $this->hasOne(Empleado::class,'id','id_empleado');
    }

    function cliente () {
    	return $this->hasOne(Cliente::class,'id','id_cliente');
    }

    function sucursal () {
    	return $this->hasOne(Sucursal::class,'id','id_sucursal');
    }
}
