@extends('layout.quizlayout')
@section('content')
    <div class="outer m-5 row align-center justify-content-center">
        <div class="h-25 w-75 m-1 text-center">
            <h2 class="mb-4">BTECH/Diploma/BCA</h2>
            <h3 class="mb-4">Test - {{$test->name}}</h3>
            <section id="instructions" class="mt-4">
                <h2 class="mb-4">Instructions</h2>
                <ul class="list-group">
                    <li class="list-group-item">This test is only MCQ based.</li>
                    <li class="list-group-item">Only one correct answer for each question.</li>
                    <li class="list-group-item">The test shall consists of {{$test->no_of_questions}} questions with time duration of {{$test->duration}} minutes.</li>
                    <li class="list-group-item">Marking Scheme <span class="text-success">+1</span> mark for correct answer
                        and <span class="text-danger">-0.25</span> marks for wrong answer.
                    </li>
                    <li class="list-group-item">You cannot change your answer once it's submitted.</li>
                    <li class="list-group-item">Do not refresh or leave the page during the test otherwise you will have to start again from the first question.</li>
                    <li class="list-group-item">The timer will start once you begin the test.</li>
                    <li class="list-group-item">Test will automatically submit after the completion of time.</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('student.quiz') }}?test_id={{$test->test_id}}"><button class="btn btn-primary">Continue to Start
                            Test</button></a>
                </div>
            </section>
        </div>
    </div>
@endsection
