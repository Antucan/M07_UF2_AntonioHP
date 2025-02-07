<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0d3fa9;
        }

        /* cambio el color de fondo de las secciones */
        #content {
            background-color: #ffa900;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
        }

        /* cambio el color de los hr */
        hr {
            background-color: #0d3fa9;
        }
    </style>
</head>

<body class="container">
    @section('header')
    <div style="background-color: #ffa900; height: 100px;">
        <a href="{{ url('/')}}">
            <img style="height: 100px"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Blockbuster_logo.svg/1280px-Blockbuster_logo.svg.png"
                alt="Blockbuster Logo">
        </a>
    </div>
    @show

    <div id="content" class="container">
        @yield('content')
    </div>

    @section('footer')
    <footer class="my-3" style="background-color: #ffa900; height: 100px;">
        <h2 style="color: #0d3fa9">Blockbuster Video 2021</h2>
    </footer>
    @show
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>