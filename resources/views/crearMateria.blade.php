<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registro Materia</title>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/css/custom.css">
</head>

<body>

<div class="card">

<h1>Registro Materia</h1>

@if(session('success'))
<div class="mensaje">
{{ session('success') }}
</div>
@endif

<form action="{{ isset($materia) ? route('materias.update', $materia->id) : route('materias.store') }}" method="POST">

@csrf
@if(isset($materia))
    @method('PUT')
@endif

<input type="text" name="nombre" placeholder="Nombre materia" value="{{ old('nombre', $materia->nombre ?? '') }}" required>
<input type="text" name="descripcion" placeholder="Descripción" value="{{ old('descripcion', $materia->descripcion ?? '') }}">
<input type="number" name="creditos" placeholder="Créditos" min="1" max="10" value="{{ old('creditos', $materia->creditos ?? '') }}" required>

<button type="submit">{{ isset($materia) ? 'Actualizar Materia' : 'Guardar Materia' }}</button>

</form>

<p style="text-align:center; margin-top:12px;"><a href="{{ route('materias.index') }}" style="color:#cfcfcf; text-decoration:none;">Ver listado de materias</a></p>

</div>

</body>
</html>