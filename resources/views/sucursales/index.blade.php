@extends('welcome')

@section('content')
	<h6>SUCURSALES</h6>
	<hr>
	<a href="{{ route('sucursal.nueva') }}">Crear sucursal</a>
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
				<th>TELEFONO</th>
				<th>DIRECCION</th>
				<th>ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sucursales as $sucursal)
				<tr>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $sucursal->nombre }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $sucursal->telefono }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">{{ $sucursal->direccion }}</td>
					<td style="border-bottom: 1px solid #ccc; padding: 10px;">
						<a href="{{ route('sucursal.editar',$sucursal->id) }}">Editar</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('script')
	<script>
		$(function(){
			console.log('sucursales');
		});
	</script>
@endsection