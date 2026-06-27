<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro Profesor</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/custom.css">
</head>

<body>

<div class="card">

<h1>Registro Profesor</h1>

@if(session('success'))
<div class="mensaje">
{{ session('success') }}
</div>
@endif

<form action="{{ isset($profesor) ? route('profesores.update', $profesor->id) : route('profesores.store') }}" method="POST">

@csrf
@if(isset($profesor))
    @method('PUT')
@endif

<input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre', $profesor->nombre ?? '') }}" required>
<input type="text" name="apellido" placeholder="Apellido" value="{{ old('apellido', $profesor->apellido ?? '') }}" required>
<input type="email" name="correo" placeholder="Correo" value="{{ old('correo', $profesor->correo ?? '') }}" required>

<button type="submit">{{ isset($profesor) ? 'Actualizar Profesor' : 'Guardar Profesor' }}</button>

</form>

<p style="text-align:center; margin-top:12px;"><a href="{{ route('profesores.index') }}" style="color:#cfcfcf; text-decoration:none;">Ver listado de profesores</a></p>

</div>

</body>
</html>