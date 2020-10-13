<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Empleado;

class Sucursal extends Model
{
	protected $table = 'sucursales';
    protected $fillable = [
    	'id','nombre','telefono','direccion'
    ];
    public $timestamps = false;

    public function empleado () {
    	return $this->hasMany(Empleado::class);
    } 
}
