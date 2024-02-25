@extends('layout.quizlayout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading m-3">
                        <h1 class="text-center m-2">Scorecard</h1>
                        <h4 class="text-center m-3" style="color:#069;">Paper : <span style="color:#000;">
                            {{ $test->name }}</span></h4>
                        <h4 class="text-center m-3" style="color:#069;">Date : <span style="color:#000;">
                            {{ date('d-m-Y', strtotime($test->date)) }}</span></h4>
                    </div>
                    <div class="panel-body text-center">
                        <ul class="list-group mb-5" style="list-style-type:none;">
                            <div class="d-flex justify-content-evenly mb-4">
                                <div class="mt-4 w-25">
                                    <li class="card px-3"
                                        style="height: auto; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25); border: none;">
                                        <i class="fas fa-question-circle fa-2x text-primary mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Total Questions</span> :
                                            {{ $r->total_questions }}</h4>
                                    </li>
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                        <i class="far fa-solid fa-clock fa-2x text-primary mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Total Time</span> :
                                            {{ $test->duration }}Min</h4>
                                    </li>
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                        <i class="far fa-solid fa-clock fa-2x text-primary mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Time Taken</span> :
                                            {{ $time_taken }}</h4>
                                    </li>
                                    
                                </div>
                                <div class="w-25">
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                        <i class="far fa-solid fa-list-check fa-2x text-primary mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Attempted</span> :
                                            {{ $r->attemted }}</h4>
                                    </li>
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                        <i class="fas fa-check-circle fa-2x text-success mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Correct</span> :
                                            {{ $r->correct }}</h4>
                                    </li>
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                        <i class="fas fa-solid fa-circle-xmark fa-2x text-danger mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Wrong</span> :
                                            {{ $r->wrong }}</h4>
                                    </li>
                                </div>
                                <div class="w-25">
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                        <i class="fas fa-solid fa-square-poll-vertical fa-2x text-primary mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Result</span> :
                                            @if ($r->total_score >= $r->total_questions / 3)
                                                <span class="text-success">Passed</span>
                                            @else
                                                <span class="text-danger">Failed</span>
                                            @endif
                                        </h4>
                                    </li>
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                        <i class="fas fa-star fa-2x text-warning mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Score</span> :
                                            {{ $r->total_score }}/{{ $r->total_questions }}</h4>
                                    </li>
                                    <li class="card px-3 mt-4"
                                        style="height: auto;box-shadow: 0px 0px 10px rgba(66, 65, 65, 0.25);border:none;">
                                        <i class="fas fa-percentage fa-2x text-primary mt-3"></i>
                                        <h4 class="mt-3"><span style="color:#069;">Score %</span> :
                                            {{ round(($r->total_score * 100) / $r->total_questions ?? 1, 2) }}% <span
                                                style="color:#069;">/</span> 100% </h4>
                                    </li>
                                </div>
                            </div>
                            @if ($s)
                                <li class="mt-4">
                                    <h3><span class="text-success">Your Response has been
                                            Submited Successfully</span></h3>
                                </li>
                            @else
                                <li class="mt-4">
                                    <h3><span class="text-danger">Your Response has been already
                                            Submited</span></h3>
                                </li>
                            @endif
                            <li class="mt-4">
                                <a href="{{ route('student.feedback') }}?test_id={{ $test->test_id }}"><button
                                        class="btn btn-primary"> Next -> </button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
