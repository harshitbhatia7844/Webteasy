<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Quiz</title>
    <link href={{ asset('css/bootstrap.css')}} rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/quiz.css')}}">
</head>
<body style="user-select: none">
    <nav class="navbar bg-primary">
        <div class="container-fluid mx-5">
            <a class="navbar-brand text-white" href="#">
                Online Assessment Software by HPS
            </a>
            <h4 class="nav-item text-white">{{ Auth::user()->name }}</h4>
        </div>
    </nav>
    @yield('content')
</body>
</html>
