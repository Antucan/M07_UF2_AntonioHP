<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="container">
    @section('header')
        <div style="background-color: #ffa900; height: 100px;">
            <img style="height: 100px"
                src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Blockbuster_logo.svg/1280px-Blockbuster_logo.svg.png"
                alt="Blockbuster Logo">
        </div>
    @show

    <div class="container">
        @yield('content')
    </div>

    @section('footer')
        <footer style="background-color: #0d3fa9; height: 100px;">
            <h2 style="color: #ffa900">Blockbuster Video 2021</h2>
        </footer>
    @show
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
