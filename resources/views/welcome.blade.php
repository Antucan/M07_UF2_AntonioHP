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
        <div class="d-flex justify-content-center">
            <div>
                <h1 class="mt-4">Lista de Peliculas</h1>
                <ul>
                    <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
                    <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
                    <li><a href=/filmout/films>Pelis</a></li>
                    <li><a href=/filmout/filmsByYear>Pelis por año</a></li>
                    <li><a href=/filmout/filmsByGenre>Pelis por genero</a></li>
                    <li><a href=/filmout/sortFilms>Pelis por año descendiente</a></li>
                    <li><a href=/filmout/countFilms>Contador de pelis</a></li>
                </ul>
            </div>
            <div class="mx-5">
                <h1 class="mt-4">Lista de Actores</h1>
                <ul>
                    <li><a href=/actorout/actors>List actors</a></li>
                    <li><a href=/actorout/countActors>Count actors</a></li>
                    {{-- select de decadas --}}
                    <form action="{{ route('listActorsByDecade') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select name="decade" id="decade">
                                <option value="0">Selecciona una decada</option>
                                <option value="1980">1980 to 1989</option>
                                <option value="1990">1990 to 1999</option>
                                <option value="2000">2000 to 2009</option>
                                <option value="2010">2010 to 2019</option>
                                <option value="2020">2020 to 2029</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                </ul>
            </div>
        </div>
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
