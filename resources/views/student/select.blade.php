@extends('layout.quizlayout')
@section('content')
    <nav class="navbar bg-primary">
        <div class="container-fluid mx-5">
            <a class="navbar-brand  text-white" href="#">
                Online Quiz System
            </a>
        </div>
    </nav>
    <div class="outer m-5 row align-center justify-content-center">
        <div class="h-25 w-75 m-1 text-center">
            <h2 class="mb-4">BTECH-CS Mix Test</h2>
            <section id="instructions" class="mt-4">
                <h2 class="mb-4">Instructions</h2>
                <ul class="list-group">
                    <li class="list-group-item">This test is only MCQ based.</li>
                    <li class="list-group-item">Select only one answer for each question.</li>
                    <li class="list-group-item">The test shall have 20 questions.</li>
                    <li class="list-group-item">Each question carries 1 mark</li>
                    <li class="list-group-item">Marking Scheme +1 mark for correct answer and -0.25 marks for wrong answer.
                    </li>
                    <li class="list-group-item">You cannot change your answer once it's submitted.</li>
                    <li class="list-group-item">The timer will start once you begin the test.</li>
                    <li class="list-group-item">The timer will start once you begin the quiz.</li>
                </ul>
                <div class="mt-4">
                    <a href="{{ route('student.quiz') }}"><button class="btn btn-primary">Continue to Start
                            Test</button></a>
                </div>
            </section>
        </div>
    </div>
@endsection
