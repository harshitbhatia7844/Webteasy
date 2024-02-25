@extends('layout.quizlayout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading m-3">
                        <h1 class="text-center m-2">Your Exam Scorecard</h1>
                    </div>
                    <div class="panel-body text-center">
                        <ul class="list-group mb-5" style="list-style-type:none;">
                            <li class="card" style="height: 80px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25); border: none;">
                                {{-- <h4 style="color:#069;">Course : <span style="color:#000;">BTECH/Diploma/BCA
                                    </span></h4> --}}
                                <h4 class="mt-4" style="color:#069;">Paper : <span style="color:#000;">Test1-Mix Test
                                    </span></h4>
                            </li>
                            <div class="d-flex justify-content-evenly mb-4">
                            <div class="mt-4">
                                <li class="card" style="height: 80px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25); border: none;">
                                    <i class="fas fa-question-circle fa-xl text-primary mt-3"></i>
                                    <h4 class="mt-3"><span style="color:#069;">Total Question</span> : {{ $r->total_questions }}</h4>
                                </li>
                            <li class="card mt-4" style="height: 80px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                <i class="far fa-solid fa-clock fa-xl text-primary mt-3"></i>
                                <h4 class="mt-3"><span style="color:#069;">Total Time Taken</span> :
                                    {{ $time_taken }}</h4>
                            </li>
                            <li class="card mt-4" style="height: 80px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                <i class="far fa-solid fa-list-check fa-xl text-primary mt-3"></i>
                                <h4 class="mt-3"><span style="color:#069;">You Attempted</span> :
                                    {{ $r->attemted }}</h4>
                            </li>
                        </div>
                        <div style="width: 340px;">
                            <li class="card mt-4" style="height: 80px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                <i class="fas fa-check-circle fa-xl text-success mt-3"></i>
                                <h4 class="mt-3"><span style="color:#069;">Right Answered</span> :
                                    {{ $r->correct }}</h4>
                            </li>
                            <li class="card mt-4" style="height: 80px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                <i class="fas fa-solid fa-circle-xmark fa-xl text-danger mt-3"></i>
                                <h4 class="mt-3"><span style="color:#069;">Wrong Answered</span> :
                                    {{ $r->wrong }}</h4>
                            </li>
                            <li class="card mt-4" style="height: 80px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                <i class="fas fa-star fa-xl text-warning mt-3"></i>
                                <h4 class="mt-3"><span style="color:#069;">Total Score</span> :
                                    {{ $r->total_score }}/{{ $r->total_questions }}</h4>
                            </li>
                        </div>
                        <div>
                            <li class="card mt-4" style="height: 80px;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);border:none;">
                                <i class="fas fa-solid fa-square-poll-vertical fa-xl text-primary mt-3"></i>
                                <h4 class="mt-3"><span style="color:#069;">Result</span> :
                                    @if ($r->total_score >= $r->total_questions/3)
                                        <span class="text-success">You Passed</span>
                                    @else
                                        <span class="text-danger">You Failed</span>
                                    @endif
                                </h4>
                            </li>
                            <li class="card mt-4" style="height: 80px;box-shadow: 0px 0px 10px rgba(66, 65, 65, 0.25);border:none;">
                                <i class="fas fa-percentage fa-xl text-primary mt-3"></i>
                                <h4 class="mt-3"><span style="color:#069;">Your Score %</span> :
                                    {{ round(($r->total_score * 100) / ($r->total_questions)??1, 2) }}% <span
                                        style="color:#069;">out
                                        of</span> 100% </h4>
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
                                <a href="{{ route('student.feedback') }}?test_id={{ $test_id }}"><button
                                        class="btn btn-primary"> Next -> </button></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
