<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../images/icon.png">
    <link rel="stylesheet" href="Quiz.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand  text-white" href="#">
                Online Quiz System
            </a>
        </div>
    </nav>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading m-3">
                        <h1 class="text-center m-2">Your Exam Score</h1>
                    </div>
                    <div class="panel-body" style="">
                        {{-- <ul class="list-group mb-5">
                            <li class="list-group-item">
                                <h4 style="text-align: center;color:#069;">Subject Name : <span
                                        style="color:#000;">Subject</span></h4>
                                <h4 style="text-align: center;color:#069;">Paper Name : <span style="color:#000;">Paper
                                    </span></h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span class="text-danger">Your Response has been already
                                        Submited</span></h4>
                            </li>
                        </ul> --}}
                        <ul class="list-group mb-5">
                            <li class="list-group-item">
                                <h4 style="text-align: center;color:#069;">Course : <span style="color:#000;">BTECH-CSE
                                    </span></h4>
                                <h4 style="text-align: center;color:#069;">Paper : Test1-Mix Test <span
                                        style="color:#000;">Paper
                                    </span></h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Total Question</span> : 10</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">You Attempted</span> : 10</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Right Answered</span> : 7</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Wrong Answered</span> : 3</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">You Scored</span> : 70% <span
                                        style="color:#069;">out of</span> 100% </h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span class="text-success">Your Rank : 39 out of 137
                                        students</span></h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span class="text-success">Your Response has been
                                        Submited Successfully</span></h4>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('student.dashboard') }}"><button class="btn btn-primary"> Back to
                                        Dashboard </button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
