@extends('welcome')

@section('content')
	<h6>CLIENTES</h6>
	<hr>
	<a href="#" class="btn-registrar">Registrar cliente</a>
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
				<th>ESTADO</th>
				<th>ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			@foreach($clientes as $cliente)
				<tr>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $cliente->cliDocumento }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $cliente->cliNombres }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $cliente->cliApellidos }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $cliente->cliEstado }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">
						<a href="#" class="btn-editar">
							Editar
							<span hidden>{{ $cliente->id }}</span>
							<span hidden>{{ $cliente->cliDocumento }}</span>
							<span hidden>{{ $cliente->cliNombres }}</span>
							<span hidden>{{ $cliente->cliApellidos }}</span>
							<span hidden>{{ $cliente->cliEstado }}</span>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="modal fade" id="cliente-registrar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>REGISTRO DE CLIENTE:</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('cliente.guardar') }}" method="POST">
						@csrf
						<div class="form-group">
							<small class="text-muted">DOCUMENTO:</small>
							<input type="number" name="cliDocumento" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">NOMBRES:</small>
							<input type="text" name="cliNombres" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">APELLIDOS:</small>
							<input type="text" name="cliApellidos" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">SUCURSAL:</small>
							<select class="form-control form-control-sm" name="cliEstado" required>
								<option value="">Seleccione ...</option>
								<option value="ACTIVO">ACTIVO</option>
								<option value="INACTIVO">INACTIVO</option>
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

	<div class="modal fade" id="cliente-editar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-lg" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>ACTUALIZACION DE CLIENTE</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('cliente.actualizar') }}" method="POST">
						@csrf
						<div class="form-group">
							<small class="text-muted">DOCUMENTO:</small>
							<input type="number" name="cliDocumento_edit" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">NOMBRES:</small>
							<input type="text" name="cliNombres_edit" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">APELLIDOS:</small>
							<input type="text" name="cliApellidos_edit" class="form-control form-control-sm" required>
						</div>
						<div class="form-group">
							<small class="text-muted">SUCURSAL:</small>
							<select class="form-control form-control-sm" name="cliEstado_edit" required>
								<option value="">Seleccione ...</option>
								<option value="ACTIVO">ACTIVO</option>
								<option value="INACTIVO">INACTIVO</option>
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
			$('#cliente-registrar-modal').modal();
		});

		$('.btn-editar').on('click',function(e){
			e.preventDefault();
			let id = $(this).find('span:nth-child(1)').text();
			let documento = $(this).find('span:nth-child(2)').text();
			let nombres = $(this).find('span:nth-child(3)').text();
			let apellidos = $(this).find('span:nth-child(4)').text();
			let estado = $(this).find('span:nth-child(5)').text();
			$('input[name=id_edit]').val(id);
			$('input[name=cliDocumento_edit]').val(documento);
			$('input[name=cliNombres_edit]').val(nombres);
			$('input[name=cliApellidos_edit]').val(apellidos);
			$('select[name=cliEstado_edit]').val(estado);
			$('#cliente-editar-modal').modal();
		});
	</script>
@endsection