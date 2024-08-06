<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="contentdiv">
        @yield('content')
    </div>
    <footer class="footertext">
        <p class="text-center" style="color: hsl(217, 10%, 50.8%);">All CopyRights Rserved
            YaswantkuamrS @2024</p>
    </footer>
    @yield('cujs')
</body>

</html>
