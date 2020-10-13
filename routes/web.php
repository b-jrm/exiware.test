<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sucursales',"GestionController@sucursalesTo")->name('sucursales');
Route::get('/sucursales/nueva',"GestionController@sucursalesNueva")->name('sucursal.nueva');
Route::post('/sucursales/guardar',"GestionController@sucursalesGuardar")->name('sucursal.guardar');
Route::get('/sucursales/editar/{id}',"GestionController@sucursalesEditar")->name('sucursal.editar');
Route::post('/sucursales/actualizar',"GestionController@sucursalesActualizar")->name('sucursal.actualizar');


Route::get('/empleados',"GestionController@empleadosTo")->name('empleados');
Route::post('/empleados/guardar',"GestionController@empleadoGuardar")->name('empleado.guardar');
Route::post('/empleados/actualizar',"GestionController@empleadoActualizar")->name('empleado.actualizar');


Route::get('/clientes',"GestionController@clientesTo")->name('clientes');
Route::post('/clientes/guardar',"GestionController@clienteGuardar")->name('cliente.guardar');
Route::post('/clientes/actualizar',"GestionController@clienteActualizar")->name('cliente.actualizar');


Route::get('/productos',"GestionController@productosTo")->name('productos');
Route::post('/productos/guardar',"GestionController@productoGuardar")->name('producto.guardar');
Route::post('/productos/actualizar',"GestionController@productoActualizar")->name('producto.actualizar');


Route::get('/pedidos',"GestionController@pedidosTo")->name('pedidos');
Route::post('/pedidos/guardar',"GestionController@pedidoGuardar")->name('pedido.guardar');
Route::get('/pedidos/detalles',"GestionController@pedidoDetalles")->name('pedido.detalles');
