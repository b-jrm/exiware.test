<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
    	'id','proNombre','proStock'
    ];
    public $timestamps = false;
}
