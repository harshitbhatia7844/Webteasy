@extends('layout.quizlayout')
@section('content')
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
                            
                        </ul> --}}
                        <ul class="list-group mb-5">
                            <li class="list-group-item">
                                <h4 style="text-align: center;color:#069;">Course : <span style="color:#000;">BTECH-CSE
                                    </span></h4>
                                <h4 style="text-align: center;color:#069;">Paper : <span style="color:#000;">Test1-Mix Test
                                    </span></h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Total Question</span> :
                                    {{ $r->total_questions }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">You Attempted</span> :
                                    {{ $r->attemted }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Right Answered</span> :
                                    {{ $r->correct }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Wrong Answered</span> :
                                    {{ $r->wrong }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Total Score</span> :
                                    {{ $r->total_score }}/{{ $r->total_questions }}</h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span style="color:#069;">Your Score %age</span> :
                                    {{ ($r->total_score * 100) / $r->total_questions ?: 1 }}% <span style="color:#069;">out
                                        of</span> 100% </h4>
                            </li>
                            <li class="list-group-item">
                                <h4 style="text-align:center;"><span class="text-success">Your Rank : {{ $rank }}
                                        out of {{ $total }} students</span></h4>
                            </li>
                            @if ($s)
                                <li class="list-group-item">
                                    <h4 style="text-align:center;"><span class="text-success">Your Response has been
                                            Submited Successfully</span></h4>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <h4 style="text-align:center;"><span class="text-danger">Your Response has been already
                                            Submited</span></h4>
                                </li>
                            @endif
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
@endsection
