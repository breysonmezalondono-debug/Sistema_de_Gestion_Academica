<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Materias</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/custom.css">
</head>
<body>

<nav class="site-links">
    <a href="/">inicio</a>
    <a href="/estudiantes">Estudiantes</a>
    <a href="/profesores">Profesores</a>
    <a href="/materias">Materias</a>
</nav>

<main class="list-card">
    <h1>LISTADO DE MATERIAS</h1>

    <p><a href="{{ route('materias.create') }}">Crear nueva materia</a></p>

    @if(isset($materias) && count($materias))
        <ul>
        @foreach($materias as $m)
            <li>
                <span>{{ $m->nombre }} — {{ $m->creditos }} créditos</span>
                <small class="action-links">
                    <a href="{{ route('materias.edit', $m->id) }}">Editar</a>
                    <form action="{{ route('materias.destroy', $m->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Eliminar esta materia?')">Eliminar</button>
                    </form>
                </small>
            </li>
        @endforeach
        </ul>
    @else
        <p>No hay materias aún.</p>
    @endif

</main>

</body>
</html>