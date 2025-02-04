<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> --}}

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">
    @extends('layout.master')
    @section('header')
        @parent
    @endsection

    @section('content')
        <h1 class="mt-4">Lista de Peliculas</h1>
        <ul>
            <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
            <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
            <li><a href=/filmout/films>Pelis</a></li>
            <li><a href=/filmout/filmsByYear>Pelis por año</a></li>
            <li><a href=/filmout/filmsByGenre>Pelis por genero</a></li>
            <li><a href=/filmout/sortFilms>Pelis por año descendiente</a></li>
            <li><a href=/filmout/countFilms>Contador de pelis</a></li>
            <li><a href=/filmout/deleteFilm>Borrar pelicula</a></li>
        </ul>
        {{-- Add film --}}
        @if (!empty($status))
            <p style="color:red;">{{ $status }}</p>
        @endif
        <hr>
        <h2 class="mt-4">Añadir Pelicula</h2>
        <form action="{{ route('createFilm') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Titulo</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="year">Año</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="genre">Genero</label>
                <input type="text" class="form-control" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="country">Pais</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="duration">Duracion</label>
                <input type="number" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="form-group">
                <label for=img_url>Imagen URL</label>
                <input type="text" class="form-control" id="img_url" name="img_url" required>
            </div>

            <button type="submit" class="btn btn-primary">Añadir</button>
        </form>
        <hr>
        <h2>Borrar Pelicula</h2>
        <form action="{{ route('deleteFilm') }}" method="POST">
            <label for="film_name">Pelicula a borrar</label>
            <input type="text" class="form-control" id="film_name" name="film_name" required>
            <button type="submit" class="btn btn-primary">Borrar</button>
        </form>
        
        <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
        {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
    @endsection

    @section('footer')
        @parent
    @endsection
</body>

</html>
