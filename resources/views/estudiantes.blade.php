<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Estudiantes</title>
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
    <h1>SISTEMA DE ESTUDIANTES</h1>

    <p><a href="{{ route('estudiantes.create') }}">Crear nuevo estudiante</a></p>

    <h2>LISTADO DE ESTUDIANTES</h2>
    @if(isset($estudiantes) && count($estudiantes))
        <ul>
        @foreach($estudiantes as $e)
            <li>
                <span>{{ $e->nombre }} {{ $e->apellido }} — {{ $e->programa }}</span>
                <small class="action-links">
                    <a href="{{ route('estudiantes.edit', $e->id) }}">Editar</a>
                    <form action="{{ route('estudiantes.destroy', $e->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Eliminar este estudiante?')">Eliminar</button>
                    </form>
                </small>
            </li>
        @endforeach
        </ul>
    @else
        <p>No hay estudiantes aún.</p>
    @endif

</main>

</body>
</html>