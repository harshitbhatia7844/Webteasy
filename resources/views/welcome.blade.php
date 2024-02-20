<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HPS - Online Quiz</title>
    <link href={{ asset('css/bootstrap.css') }} rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <section class="vh-100 py-5 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent text-white" style="border-radius: 1.5rem; border:1px solid white;">
                        <div class="card-body p-5 text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="" style="height: 10rem">
                            <h2 class="fw-bold my-3 text-uppercase text-white">Webteasy Quiz Application</h2>
                            <p class="text-white mb-3">Welcome to Our Home Page!</p>
                            <a class="btn btn-outline-light btn-lg px-5 w-75 my-4 p-3" role="button"
                                href={{ route('student.login') }}>
                                Student Login
                            </a>
                            <a class="btn btn-outline-light btn-lg px-5 w-75 my-4 p-3" role="button"
                                href={{ route('admin.login') }}>
                                Admin Login
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
