@extends('welcome')

@section('content')
	<h6>MODIFICACION DE SUCURSAL {{ $sucursal->nombre }}</h6>
	<hr>
	<form action="{{ route('sucursal.actualizar') }}" method="POST">
		@csrf
		<hr>
		<small>NOMBRE:</small>
		<input type="text" name="nombre" value="{{ $sucursal->nombre }}" required>
		<hr>
		<small>TELEFONO:</small>
		<input type="text" name="telefono" value="{{ $sucursal->telefono }}" required>
		<hr>
		<small>DIRECCION:</small>
		<input type="text" name="direccion" value="{{ $sucursal->direccion }}" required>
		<hr>
		<input type="hidden" name="id" value="{{ $sucursal->id }}" readonly required>
		<button type="submit">GUARDAR</button>
	</form>
@endsection