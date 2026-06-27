<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profesores</title>
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
    <h1>SISTEMA DE PROFESORES</h1>

    <p><a href="{{ route('profesores.create') }}">Crear nuevo profesor</a></p>

    <h2>LISTADO DE PROFESORES</h2>
    @if(isset($profesores) && count($profesores))
        <ul>
        @foreach($profesores as $p)
            <li>
                <span>{{ $p->nombre }} {{ $p->apellido }} — {{ $p->correo }}</span>
                <small class="action-links">
                    <a href="{{ route('profesores.edit', $p->id) }}">Editar</a>
                    <form action="{{ route('profesores.destroy', $p->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Eliminar este profesor?')">Eliminar</button>
                    </form>
                </small>
            </li>
        @endforeach
        </ul>
    @else
        <p>No hay profesores aún.</p>
    @endif

</main>

</body>
</html>