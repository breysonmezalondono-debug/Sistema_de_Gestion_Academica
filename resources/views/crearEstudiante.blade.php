<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registro de Estudiantes</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="/css/custom.css">

 

</head>

<body>

<div class="card">

<h1> Registro</h1>

<p>Completa la información del estudiante</p>

@if(session('success'))
<div class="mensaje">
{{ session('success') }}
</div>
@endif

<form action="{{ isset($estudiante) ? route('estudiantes.update', $estudiante->id) : route('estudiantes.store') }}" method="POST">

@csrf
@if(isset($estudiante))
    @method('PUT')
@endif

<input type="text" name="nombre" placeholder=" Nombre" value="{{ old('nombre', $estudiante->nombre ?? '') }}" required>

<input type="text" name="apellido" placeholder=" Apellido" value="{{ old('apellido', $estudiante->apellido ?? '') }}" required>

<input type="number" name="edad" placeholder=" Edad" min="1" max="120" value="{{ old('edad', $estudiante->edad ?? '') }}" required>

<input type="email" name="correo" placeholder=" Correo electrónico" value="{{ old('correo', $estudiante->correo ?? '') }}" required>

<input type="text" name="programa" placeholder=" Programa" value="{{ old('programa', $estudiante->programa ?? '') }}" required>

<button type="submit">
    {{ isset($estudiante) ? 'Actualizar Estudiante' : 'Guardar Estudiante' }}
</button>

</form>

<p style="text-align:center; margin-top:12px;"><a href="{{ route('estudiantes.index') }}" style="color:#cfcfcf; text-decoration:none;">Ver listado de estudiantes</a></p>

</div>

</body>

</html>