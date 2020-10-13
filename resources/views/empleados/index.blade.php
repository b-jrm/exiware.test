@extends('welcome')

@section('content')
	<h6>EMPLEADOS</h6>
	<hr>
	<a href="#" class="btn-registrar">Registrar empleado</a>
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
				<th>DOCUMENTO</th>
				<th>NOMBRES</th>
				<th>APELLIDOS</th>
				<th>SUCURSAL</th>
				<th>ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			@foreach($empleados as $empleado)
				<tr>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $empleado->documento }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $empleado->nombres }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $empleado->apellidos }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $empleado->sucursal->nombre }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">
						<a href="#" class="btn-editar">
							Editar
							<span hidden>{{ $empleado->id }}</span>
							<span hidden>{{ $empleado->documento }}</span>
							<span hidden>{{ $empleado->nombres }}</span>
							<span hidden>{{ $empleado->apellidos }}</span>
							<span hidden>{{ $empleado->id_sucursal }}</span>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="modal fade" id="empleado-registrar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>REGISTRO DE EMPLEADO</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('empleado.guardar') }}" method="POST">
						@csrf
						<div class="form-group">
							<small class="text-muted">DOCUMENTO:</small>
							<input type="number" name="documento" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">NOMBRES:</small>
							<input type="text" name="nombres" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">APELLIDOS:</small>
							<input type="text" name="apellidos" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">SUCURSAL:</small>
							<select class="form-control form-control-sm" name="id_sucursal" required>
								<option value="">Seleccione ...</option>
								@foreach($sucursales as $sucursal)
									<option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success">REGISTRAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="empleado-editar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-lg" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>ACTUALIZACION DE EMPLEADO</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('empleado.actualizar') }}" method="POST">
						@csrf
						<div class="form-group">
							<small class="text-muted">DOCUMENTO:</small>
							<input type="number" name="documento_edit" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">NOMBRES:</small>
							<input type="text" name="nombres_edit" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">APELLIDOS:</small>
							<input type="text" name="apellidos_edit" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">SUCURSAL:</small>
							<select class="form-control form-control-sm" name="id_sucursal_edit" required>
								<option value="">Seleccione ...</option>
								@foreach($sucursales as $sucursal)
									<option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
								@endforeach
							</select>
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
			$('#empleado-registrar-modal').modal();
		});

		$('.btn-editar').on('click',function(e){
			e.preventDefault();
			let id = $(this).find('span:nth-child(1)').text();
			let documento = $(this).find('span:nth-child(2)').text();
			let nombres = $(this).find('span:nth-child(3)').text();
			let apellidos = $(this).find('span:nth-child(4)').text();
			let sucursal = $(this).find('span:nth-child(5)').text();
			$('input[name=id_edit]').val(id);
			$('input[name=documento_edit]').val(documento);
			$('input[name=nombres_edit]').val(nombres);
			$('input[name=apellidos_edit]').val(apellidos);
			$('select[name=id_sucursal_edit]').val(sucursal);
			$('#empleado-editar-modal').modal();
		});
	</script>
@endsection