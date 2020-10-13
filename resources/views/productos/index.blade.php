@extends('welcome')

@section('content')
	<h6>PRODUCTOS</h6>
	<hr>
	<a href="#" class="btn-registrar">Registrar producto</a>
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
				<th>NOMBRE</th>
				<th>STOCK</th>
				<th>ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			@foreach($productos as $producto)
				<tr>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $producto->proNombre }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $producto->proStock }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">
						<a href="#" class="btn-editar">
							Editar
							<span hidden>{{ $producto->id }}</span>
							<span hidden>{{ $producto->proNombre }}</span>
							<span hidden>{{ $producto->proStock }}</span>
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<div class="modal fade" id="producto-registrar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>REGISTRO DE PRODUCTO:</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('producto.guardar') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-9">
								<div class="form-group">
									<small class="text-muted">NOMBRE:</small>
									<input type="text" name="proNombre" class="form-control form-control-sm" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small class="text-muted">STOCK:</small>
									<input type="number" name="proStock" class="form-control form-control-sm" required>
								</div>
							</div>
						</div>								
						<div class="form-group">
							<button type="submit" class="btn btn-success">REGISTRAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="producto-editar-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content modal-lg" style="font-size: 12px;">
				<div class="modal-header">
					<h6><b>ACTUALIZACION DE PRODUCTO</b></h6>
					<button type="button" data-dismiss="modal" class="close" aria-label="Close">&times;</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('producto.actualizar') }}" method="POST">
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
			$('#producto-registrar-modal').modal();
		});

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
	</script>
@endsection