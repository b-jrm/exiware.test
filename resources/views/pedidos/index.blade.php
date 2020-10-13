@extends('welcome')

@section('content')
	<h6>PEDIDOS</h6>
	<hr>
	<a href="#" class="btn-registrar">Nuevo pedido</a>
	<hr>
	@if(session('info'))
	    <div class="alert alert-info" style="border: 3px solid green; background-color: #ccc; border-radius: 20px; padding: 10px; text-align: center;">
	    	<small>INFORMACION: </small><br>
	        {{ session('info') }}
	    </div>
	@endif
	<table width="100%" style="text-align: center; font-size: 12px;">
		<thead style="background-color: yellow;">
			<tr>
				<th>SUCURSAL</th>
				<th>EMPLEADO</th>
				<th>CLIENTE</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($pedidos as $pedido)
				<tr>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $pedido->sucursal->nombre }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $pedido->empleado->nombres . ' ' . $pedido->empleado->apellidos }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $pedido->cliente->cliNombres . ' ' . $pedido->cliente->cliApellidos }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">
						<a href="#" class="btn-editar">
							Ver detalle
							<span hidden>{{ $pedido->id }}</span>
							<span hidden>{{ $pedido->id_empleado }}</span>
							<span hidden>{{ $pedido->id_cliente }}</span>
							<span hidden>{{ $pedido->id_sucursal }}</span>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="modal fade" id="pedido-registrar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>REGISTRO DE PEDIDO:</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('pedido.guardar') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<small class="text-muted">SUCURSAL:</small>
									<select class="form-control form-control-sm" name="id_sucursal" required>
										<option value="">Seleccione ...</option>
										@foreach($sucursales as $sucursal)
											<option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<small class="text-muted">EMPLEADO:</small>
									<select class="form-control form-control-sm" name="id_empleado" required>
										<option value="">Seleccione ...</option>
										<!-- options dinamicas -->
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<small class="text-muted">CLIENTE:</small>
									<select class="form-control form-control-sm" name="id_cliente" required>
										<option value="">Seleccione ...</option>
										@foreach($clientes as $cliente)
											<option value="{{ $cliente->id }}" data-estado="{{ $cliente->cliEstado }}">{{ $cliente->cliNombres . ' '. $cliente->cliApellidos }}</option>
										@endforeach
									</select>
									<span hidden class="no-estado" style="color: red; font-weight: bold;">Cliente inactivo</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<small class="text-muted">PRODUCTO:</small>
											<select class="form-control form-control-sm" name="producto">
												<option value="">Seleccione ...</option>
												@foreach($productos as $producto)
													<option value="{{ $producto->id }}" data-producto="{{ $producto->proNombre }}" data-stock="{{ $producto->proStock }}">{{ $producto->proNombre }}</option>
												@endforeach
											</select>
											<span hidden class="no-stock" style="color: red; font-weight: bold;">Producto sin stock</span>
										</div>
									</div>
									<div class="col-md-6">
										<button type="button" class="btn btn-info btn-add mt-3" disabled>AGREGAR PRODUCTO</button>
										<span hidden class="repetido" style="color: red; font-weight: bold;">El producto ya esta agregado</span>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<table class="table table-stroped text-center tbl-products-pedido" width="100%">
											<thead>
												<tr>
													<th>PRODUCTO</th>
													<th>CANTIDAD</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>							
						<div class="form-group text-center">
							<span hidden class="no-productos" style="color: red; font-weight: bold;">Seleccione al menos un producto</span>
							<input type="hidden" name="todos_los_productos" class="form-control form-control-sm" readonly required>
							<button type="submit" class="btn btn-success btn-guardar" disabled>PROCESAR PEDIDO</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="pedido-editar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-lg" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>DETALLES DE PEDIDO</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('pedido.detalles') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-9">
								<div class="form-group">
									<small class="text-muted">NOMBRE:</small>
									<input type="text" name="proNombre_edit" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small class="text-muted">STOCK:</small>
									<input type="number" name="proStock_edit" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="form-group">
							<input type="hidden" name="id_edit" class="form-control form-control-sm" required>
							<button type="submit" class="btn btn-primary">GUARDAR CAMBIOS</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$('.btn-registrar').on('click',function(e){
			e.preventDefault();
			$('#pedido-registrar-modal').modal();
		});

		$('select[name=id_sucursal]').on('change',function(e){
			let selected = e.target.value;
			$('select[name=id_empleado]').empty();
			$('select[name=id_empleado]').append("<option value=''>Seleccione ...</option>");
			if(selected != ''){
				$.get("{{ route('getEmpleados') }}",{ id_sucursal: selected },function(objectEmpleados){
					let count = Object.keys(objectEmpleados).length;
					if(count > 0){
						for (var i = 0; i < count; i++) {
							$('select[name=id_empleado]').append("<option value='" + objectEmpleados[i]['id'] + "'>" + objectEmpleados[i]['nombres'] + " " + objectEmpleados[i]['apellidos'] + "</option>");
						}
					}
				});
			}
		});

		$('select[name=id_cliente]').on('change',function(e){
			let selected = e.target.value;
			$('.btn-guardar').attr('disabled',true);
			$('.no-estado').attr('hidden',true);
			if(selected != ''){
				habilitarGuardado();
			}
		});

		$('select[name=producto]').on('change',function(e){
			let selected = e.target.value;
			$('.btn-add').attr('disabled',true);
			$('.no-stock').attr('hidden',true);
			if(selected != ''){
				let stock = parseInt($('select[name=producto] option:selected').attr('data-stock'));
				if(stock > 0){
					$('.btn-add').attr('disabled',false);
				}else{
					$('.no-stock').attr('hidden',false);
				}
			}
		});

		$('.btn-add').on('click',function(){
			let id = $('select[name=producto]').val();
			let producto = $('select[name=producto] option:selected').attr('data-producto');
			let stock = parseInt($('select[name=producto] option:selected').attr('data-stock'));
			let validarAgregado = false;
			$('.tbl-products-pedido tbody tr').each(function(){
				let idClass = $(this).attr('class');
				if(id === idClass){
					validarAgregado = true;
				}
			});
			if(id != ''){
				if(!validarAgregado){
					$('.tbl-products-pedido tbody').append(
						"<tr class='" + id + "'>" +
							"<td>" + producto + "</td>" +
							"<td>" +
								"<input type='number' class='form-control form-control-sm text-center cantidad' required>" +
							"</td>" +
							"<td>" +
								"<button type='button' class='btn btn-warning btn-quitar'>QUITAR</button>" +
							"</td>" +
						"</tr>"
					);
				}else{
					$('.repetido').attr('hidden',false);
					setTimeout(function(){
						$('.repetido').attr('hidden',true);
					},3000);
				}
			}
		});

		$('.tbl-products-pedido').on('click','.btn-quitar',function(){
			$(this).parents('tr').remove();
			obtenerProductos(1);
			habilitarGuardado();
		});

		$('.tbl-products-pedido').on('change keyup','input.cantidad',function(){
			obtenerProductos(1);
		});

		$('.btn-guardar').on('click',function(e){
			let productos = obtenerProductos();
			if(productos != ''){
				$(this).submit();
			}else{
				e.preventDefault();
				$('.no-productos').attr('hidden',false);
				setTimeout(function(){
					$('.no-productos').attr('hidden',true);
				},3000);
			}
		});

		function obtenerProductos (resultado = 0, productos = '') {
			$('.no-productos').attr('hidden',true);
			$('input[name=todos_los_productos]').val('');
			$('.tbl-products-pedido tbody tr').each(function(){
				let id = $(this).attr('class');
				let producto = $(this).find('td:nth-child(1)').text();
				let cantidad = $(this).find('td:nth-child(2)').find('input.cantidad').val();
				productos += id + '==>' + producto + '==>' + cantidad + '===>';
			});
			$('input[name=todos_los_productos]').val(productos);
			if(resultado === 0){
				return productos;
			}
		}

		$('.btn-editar').on('click',function(e){
			e.preventDefault();
			let id = $(this).find('span:nth-child(1)').text();
			let nombre = $(this).find('span:nth-child(2)').text();
			let stock = $(this).find('span:nth-child(3)').text();
			$('input[name=id_edit]').val(id);
			$('input[name=proNombre_edit]').val(nombre);
			$('input[name=proStock_edit]').val(stock);
			$('#producto-editar-modal').modal();
		});


		function habilitarGuardado () {
			$('.btn-guardar').attr('disabled',true);
			let activo = $('select[name=id_cliente] option:selected').attr('data-estado');
			let totalProductos = $('.tbl-products-pedido tbody tr').length;
			if(activo === 'ACTIVO'){
				if(totalProductos > 0){
					$('.btn-guardar').attr('disabled',false);
				}
			}else{
				$('.no-estado').attr('hidden',false);
			}
		}
	</script>
@endsection