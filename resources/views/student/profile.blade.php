@extends('layout.studentlayout')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/overlay.css') }}">
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <div class="d-flex justify-content-between">
                        <h3 class="text-primary">My Profile</h3>
                    <a class="" onclick="on()">Edit</a>
                    </div>
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Muit Roll No.</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $roll_no }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Name</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $name }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Email</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $email }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Contact Number</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $mobile_no }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Gender</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $gender }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Course</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $course }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Branch</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $branch }}</h5>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-1">
                                <div class="col-md-3 ps-2">

                                    <h6 class="mb-0">Semester</h6>

                                </div>
                                <div class="col-md-9 pe-2">

                                    <h5>{{ $semester }}</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div id="overlay">
        <div class="form-content-1">
            <button class="cross" onclick="off()">
                X
            </button>
            <b>
                <h1>Update Profile</h1>
            </b>
            <form action="{{route('student.updateprofile')}}" method="post">
                @csrf
                <div class="small-1">
                    <input type="text" name="roll_no" placeholder="Roll No" value="{{ $roll_no }}" />
                    <input type="text" name="name" placeholder="Your Name" value="{{ $name }}" />
                </div>
                <div class="big-1">
                    <input type="email" name="email" placeholder="Email Address" value="{{ $email }}" />
                    <div class="small-1">
                        <input type="text" name="mobile_no" placeholder="Phone Number" value="{{ $mobile_no }}" minlength="10"
                            maxlength="10" />
                        <input type="text" name="gender" placeholder="Gender" value="{{ $gender }}" />
                    </div>
                    <div class="small-1">
                        <input type="text" name="course" placeholder="Course" value="{{ $course }}" />
                        <input type="text" name="branch" placeholder="Branch" value="{{ $branch }}" />
                    </div>
                    <div class="small-1">
                        <input type="text" name="semester" placeholder="Semester" value="{{ $semester }}" />
                    </div>
                    <button class="btn5-1" href="#">Submit +</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function on() {
            document.getElementById("overlay").style.display = "flex";
        }

        function off() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
@endsection
