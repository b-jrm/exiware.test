<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle_pedido extends Model
{
    protected $table = 'detalles_pedidos';
    protected $fillable = [
    	'id','id_pedido','id_producto'
    ];
    public $timestamps = false;

    public function pedidos () {
    	return $this->hasMany(Pedido::class,'id_pedido');
    }

    public function productos () {
    	return $this->hasMany(Producto::class,'id_producto');
    }
}
