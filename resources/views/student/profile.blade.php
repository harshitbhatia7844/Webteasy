@extends('layout.studentlayout')
@section('content')
    <section class="h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-9">
                    <h1 class="text-primary">My Profile</h1>
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Muit Roll No.</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5>{{$roll_no}}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">

                                        <h6 class="mb-0">Name</h6>

                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5>{{$name}}</h5>

                                    </div>
                                </div>

                                <hr class="mx-n3">
                                
                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Email</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">

                                        <h5>{{$email}}</h5>

                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Contact Number</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$mobile_no}}</h5>
                                        
                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Gender</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$gender}}</h5>
                                        
                                    </div>
                                </div>

                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Course</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$course}}</h5>
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Branch</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$branch}}</h5>
                                        
                                    </div>
                                </div>
                                
                                <hr class="mx-n3">

                                <div class="row align-items-center py-1">
                                    <div class="col-md-3 ps-2">
                                        
                                        <h6 class="mb-0">Semester</h6>
                                        
                                    </div>
                                    <div class="col-md-9 pe-2">
                                        
                                        <h5>{{$semester}}</h5>
                                        
                                    </div>
                                </div>
                                
                            </div>

                </div>
            </div>
        </div>
    </section>
@endsection
