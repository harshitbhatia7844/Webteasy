<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HPS - Online Quiz</title>
    <link href={{ asset('css/bootstrap.css')}} rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
</head>
<body>
    <section class="h-100 py-5 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: 1.5rem; border:1px solid white;">
                        <div class="card-body p-5 text-center">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
