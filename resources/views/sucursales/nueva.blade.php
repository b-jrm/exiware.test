@extends('welcome')

@section('content')
	<h6>NUEVA SUCURSAL</h6>
	<hr>
	<form action="{{ route('sucursal.guardar') }}" method="POST">
		@csrf
		<hr>
		<small>NOMBRE:</small>
		<input type="text" name="nombre" required>
		<hr>
		<small>TELEFONO:</small>
		<input type="text" name="telefono" required>
		<hr>
		<small>DIRECCION:</small>
		<input type="text" name="direccion" required>
		<hr>
		<button type="submit">GUARDAR</button>
	</form>
@endsection