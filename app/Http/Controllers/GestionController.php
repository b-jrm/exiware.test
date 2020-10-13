<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sucursal;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Detalle_pedido;

class GestionController extends Controller
{
	// FUNCIONES DE MODULO DE SUCURSALES
    function sucursalesTo () {
        $sucursales = Sucursal::all();
    	return view('sucursales.index',compact('sucursales'));
    }

    function sucursalesNueva () {
        return view('sucursales.nueva');
    }

    function sucursalesGuardar (Request $request) {
        Sucursal::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion
        ]);
        return redirect()->route('sucursales')->with('info', 'Nueva sucursal (' . $request->nombre . '), Guardada!');
    }

    function sucursalesEditar ($id) {
        $sucursal = Sucursal::find($id);
        if($sucursal != null){
            return view('sucursales.editar',compact('sucursal'));
        }else{
            return redirect()->route('sucursales')->with('info', 'No se encuentra la sucursal a editar');
        }
    }

    function sucursalesActualizar (Request $request) {
        $validate = Sucursal::where('documento',trim($request->documento))->where('id','!=',trim($request->id))->first();
        if($validate == null){
            $sucursal = Sucursal::find($request->id);
            if($sucursal != null){
                $sucursal->nombre = $request->nombre;
                $sucursal->telefono = $request->telefono;
                $sucursal->direccion = $request->direccion;
                $sucursal->save();
                return redirect()->route('sucursales')->with('info', 'Sucursal (' . $request->nombre . '), Actualizada!');
            }else{
                return redirect()->route('sucursales')->with('info', 'No se encuentra sucursal a actualizar');
            }   
        }else{
            return redirect()->route('sucursales')->with('info', 'Ya existe una sucursal diferente con el nombre (' . $request->nombre . '), Inténtelo de nuevo!');
        }
    }
    

	// FUNCIONES DE MODULO DE EMPLEADOS
    function empleadosTo () {
        $sucursales = Sucursal::all();
        $empleados = Empleado::all();
    	return view('empleados.index',compact('empleados','sucursales'));
    }

    function empleadoGuardar (Request $request) {
        Empleado::create([
            'documento' => trim($request->documento),
            'nombres' => trim($request->nombres),
            'apellidos' => trim($request->apellidos),
            'id_sucursal' => trim($request->id_sucursal)
        ]);
        return redirect()->route('empleados')->with('info', 'Nuevo empleado (' . trim($request->nombres) . ' ' . trim($request->apellidos) . '), Guardado!');
    }

    function empleadoActualizar (Request $request) {
        $validate = Empleado::where('nombres',trim($request->nombres_edit))
                            ->where('id_sucursal',trim($request->id_sucursal_edit))
                            ->where('id','!=',$request->id_edit)
                            ->first();
        if($validate == null){
            $empleado = Empleado::find($request->id_edit);
            if($empleado != null){
                $empleado->documento = trim($request->documento_edit);
                $empleado->nombres = trim($request->nombres_edit);
                $empleado->apellidos = trim($request->apellidos_edit);
                $empleado->id_sucursal = trim($request->id_sucursal_edit);
                $empleado->save();
                return redirect()->route('empleados')->with('info', 'Empleado (' . trim($request->nombres_edit) . ' ' . trim($request->apellidos_edit) . '), Actualizado!');
            }else{
                return redirect()->route('empleados')->with('info', 'No se encuentra el empleado a actualizar, intentelo de nuevo!');
            }   
        }else{
            return redirect()->route('empleados')->with('info', 'Ya existe un empleado con el numero de identificación indicada, Inténtelo de nuevo!');
        }
    }

    function clientesTo () {
        $clientes = Cliente::all();
    	return view('clientes.index',compact('clientes'));
    }

    function clienteGuardar (Request $request) {
        $validate = CLiente::where('cliDocumento',trim($request->cliDocumento))->first();
        if($validate == null){
            Cliente::create([
                'cliDocumento' => trim($request->cliDocumento),
                'cliNombres' => trim($request->cliNombres),
                'cliApellidos' => trim($request->cliApellidos),
                'cliEstado' => trim($request->cliEstado)
            ]);
            return redirect()->route('clientes')->with('info', 'Nuevo cliente (' . trim($request->cliNombres) . ' ' . trim($request->cliApellidos) . '), Guardado!');
        }else{
            return redirect()->route('clientes')->with('info', 'Ya existe un cliente (' . trim($request->cliNombres) . ' ' . trim($request->cliApellidos) . ') con el número de identificación indicado, inténtelo de nuevo!');
        }
            
    }

    function clienteActualizar (Request $request) {
        $validate = CLiente::where('cliDocumento',trim($request->cliDocumento_edit))
                            ->where('id','!=',$request->id_edit)
                            ->first();
        if($validate == null){
            $cliente = Cliente::find($request->id_edit);
            if($cliente != null){
                $cliente->cliDocumento = trim($request->cliDocumento_edit);
                $cliente->cliNombres = trim($request->cliNombres_edit);
                $cliente->cliApellidos = trim($request->cliApellidos_edit);
                $cliente->cliEstado = trim($request->cliEstado_edit);
                $cliente->save();
                return redirect()->route('clientes')->with('info', 'Cliente (' . trim($request->cliNombres_edit) . ' ' . trim($request->cliApellidos_edit) . '), Actualizado!');
            }else{
                return redirect()->route('clientes')->with('info', 'No se encuentra el cliente a actualizar, intentelo de nuevo!');
            }   
        }else{
            return redirect()->route('clientes')->with('info', 'Ya existe un cliente con el número de identificación indicado, Inténtelo de nuevo!');
        }
    }

    function productosTo () {
        $productos = Producto::all();
        return view('productos.index',compact('productos'));
    }

    function productoGuardar (Request $request) {
        $validate = Producto::where('proNombre',trim($request->proNombre))->first();
        if($validate == null){
            Producto::create([
                'proNombre' => trim($request->proNombre),
                'proStock' => trim($request->proStock)
            ]);
            return redirect()->route('productos')->with('info', 'Nuevo producto (' . trim($request->proNombre) . '), Guardado!');
        }else{
            return redirect()->route('productos')->with('info', 'Ya existe un producto (' . trim($request->proNombre) . '), inténtelo de nuevo!');
        }       
    }

    function productoActualizar (Request $request) {
        $validate = Producto::where('proNombre',trim($request->proNombre_edit))
                            ->where('id','!=',$request->id_edit)
                            ->first();
        if($validate == null){
            $producto = Producto::find($request->id_edit);
            if($producto != null){
                $producto->proNombre = trim($request->proNombre_edit);
                $producto->proStock = trim($request->proStock_edit);
                $producto->save();
                return redirect()->route('productos')->with('info', 'Producto (' . trim($request->proNombre_edit) . '), Actualizado!');
            }else{
                return redirect()->route('productos')->with('info', 'No se encuentra el producto a actualizar, intentelo de nuevo!');
            }   
        }else{
            return redirect()->route('productos')->with('info', 'Ya existe un producto con el nombre indicado, Inténtelo de nuevo!');
        }
    }

    function pedidosTo () {
        $pedidos = Pedido::all();
        $sucursales = Sucursal::all();
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('pedidos.index',compact('pedidos','sucursales','clientes','productos'));
    }

    function pedidoGuardar (Request $request) {
        // dd($request->all());
        /*
            $request->id_sucursal
            $request->id_empleado
            $request->id_cliente
            $request->todos_los_productos   // id_Producto==>proNombre==>Cantidad===>
        */

        // GUARDAR PEDIDO
        $nuevoPedido = Pedido::create([
            'id_empleado' => trim($request->id_empleado),
            'id_cliente' => trim($request->id_cliente),
            'id_sucursal' => trim($request->id_sucursal)
        ]);

        // ACTUALIZAR STOCK DE PRODUCTOS DEL PEDIDO
        $productos = substr(trim($request->todos_los_productos),0,-4); // QUITAR LOS ULTIMOS CARACTERES (===>)
        $find = strpos($productos,'===>');
        if($find === false){
            $separated = explode('==>',$productos);
            $producto = Producto::find($separated[0]);
            if($producto != null){
                $producto->proStock -= (int)$separated[2];
                // GUARDAR DETALLES DEL PEDIDO
                Detalle_pedido::create([
                    'id_pedido' => $nuevoPedido->id,
                    'id_producto' => $producto->id
                ]);
                $producto->save();
            }
        }else{
            $separatedItems = explode('===>',$productos);
            for ($i=0; $i < count($separatedItems); $i++) { 
                $separated = explode('==>',$separatedItems[$i]);
                $producto = Producto::find($separated[0]);
                if($producto != null){
                    $producto->proStock -= (int)$separated[2];
                    // GUARDAR DETALLES DEL PEDIDO CON CADA PRODUCTO ACTUALIZADO
                    Detalle_pedido::create([
                        'id_pedido' => $nuevoPedido->id,
                        'id_producto' => $producto->id
                    ]);
                    $producto->save();
                }
            }
        }
        return redirect()->route('pedidos')->with('info', 'Nuevo pedido de empleado (' . $nuevoPedido->empleado->nombres . ' ' . $nuevoPedido->empleado->apellidos . '), Procesado!');
    }

    function pedidoDetalles (Request $request) {
        dd($request->all());
    }
}
