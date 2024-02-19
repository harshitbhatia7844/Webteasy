@extends('layout.quizlayout')
@section('content')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading m-3">
                        <h1 class="text-center m-2">Your Exam Scorecard</h1>
                    </div>
                    <div class="panel-body text-center" style="">
                        <ul class="list-group mb-5">
                            <li class="list-group-item">
                                <h4 style="color:#069;">Course : <span style="color:#000;">BTECH/Diploma/BCA
                                    </span></h4>
                                <h4 style="color:#069;">Paper : <span style="color:#000;">Test1-Mix Test
                                    </span></h4>
                            </li>
                            <li class="list-group-item">
                                <h4><span style="color:#069;">Total Question</span> :
                                    {{ $r->total_questions }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4><span style="color:#069;">You Attempted</span> :
                                    {{ $r->attemted }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4><span style="color:#069;">Right Answered</span> :
                                    {{ $r->correct }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4><span style="color:#069;">Wrong Answered</span> :
                                    {{ $r->wrong }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4><span style="color:#069;">Total Score</span> :
                                    {{ $r->total_score }}/{{ $r->total_questions }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4><span style="color:#069;">Result</span> :
                                    @if ($r->total_score >= 12)
                                        <span class="text-success">You Passed</span>
                                    @else
                                        <span class="text-danger">You Failed</span>
                                    @endif
                                </h4>
                            </li>
                            <li class="list-group-item">
                                <h4><span style="color:#069;">Your Score %</span> :
                                    {{ round(($r->total_score * 100) / ($r->total_questions)??1, 2) }}% <span
                                        style="color:#069;">out
                                        of</span> 100% </h4>
                            </li>
                            @if ($s)
                                <li class="list-group-item">
                                    <h4><span class="text-success">Your Response has been
                                            Submited Successfully</span></h4>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <h4><span class="text-danger">Your Response has been already
                                            Submited</span></h4>
                                </li>
                            @endif
                            <li class="list-group-item">
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
