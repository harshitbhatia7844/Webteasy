@extends('layout.quizlayout')
@section('content')
    <form action="{{ route('student.result') }}" method="post">
        @csrf
        <div class="container mt-3" style="user-select: none">
            <div class="header">
                <div class="navbar">
                    <h2>Course : BTECH/Diploma/BCA</h2>
                    {{-- <button class="btn btn-primary">Submit Test</button> --}}
                </div>
                <div class="navbar px-3 m-2">
                    <h3>Paper : {{ $test->name }}</h3>
                    <h6 id="timer"></h6>
                </div>
            </div>
            <div class="content d-flex justify-content-center">
                <div class="border rounded-2 m-4 w-100">
                    @php
                        $count = 0;
                        $label = 1;
                    @endphp
                    @foreach ($questions as $q)
                        <div class="border rounded-2 w-100" id="question{{ $count + 1 }}"
                            style="display:@if ($count + 1 == 1) block @else none @endif; max-height: 80vh; overflow:scroll;">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex" id="{{ ++$count }}">
                                    <div class="type m-2 px-3 py-2">
                                        {{ $count }}
                                    </div>
                                    <div class="type m-2 px-3 py-2">
                                        Marks: <span class="text-success">+1 </span> , <span
                                            class="text-danger">-0.25</span>
                                    </div>
                                    <div class="type m-2 px-3 py-2">
                                        Type: MCQ
                                    </div>
                                </div>
                                <label class="type m-2 px-3 py-2 btn btn-outline-secondary" for="optionclear{{ $count }}">
                                    Clear Response
                                </label>
                            </div>
                            <input type="hidden" name="ques{{ $count }}" value="{{ $q->id }}">
                            <div class="m-3" inert>
                                <h4>Q {{ $count }}: {{ $q->question }}</h4>
                            </div>
                            <div class="options">
                                <div class="optn my-3" onclick="selectOption({{ $count }})">
                                    <label class="w-100 d-flex align-items-center" for="option{{ $label }}" >
                                        <div class="op">1</div>
                                        {{ $q->a }}
                                    </label>
                                    <input class="form-check-input me-2" type="radio" name="option{{ $count }}"
                                        id="option{{ $label++ }}" value="a">
                                </div>
                                <div class="optn my-3" onclick="selectOption({{ $count }})">
                                    <label class="w-100 d-flex align-items-center" for="option{{ $label }}" >
                                        <div class="op">2</div>
                                        {{ $q->b }}
                                    </label>
                                    <input class="form-check-input me-2" type="radio" name="option{{ $count }}"
                                        id="option{{ $label++ }}" value="b">
                                </div>
                                <div class="optn my-3" onclick="selectOption({{ $count }})">
                                    <label class="w-100 d-flex align-items-center" for="option{{ $label }}" >
                                        <div class="op">3</div>
                                        {{ $q->c }}
                                    </label>
                                    <input class="form-check-input me-2" type="radio" name="option{{ $count }}"
                                        id="option{{ $label++ }}" value="c">
                                </div>
                                <div class="optn my-3" onclick="selectOption({{ $count }})">
                                    <label class="w-100 d-flex align-items-center" for="option{{ $label }}" >
                                        <div class="op">4</div>
                                        {{ $q->d }}
                                    </label>
                                    <input class="form-check-input me-2" type="radio" name="option{{ $count }}"
                                        id="option{{ $label++ }}" value="d">
                                </div>
                                <input class="form-check-input me-2" type="radio" name="option{{ $count }}"
                                    id="optionclear{{ $count }}" value="0" checked hidden>
                            </div>
                        </div>
                    @endforeach
                    <div class="w-100">
                        <div class="d-md-flex justify-content-evenly border-bottom rounded-1 p-2 w-100">
                            <div class="d-flex align-items-center">
                                <div class="type m-2 px-3 py-2 bg-success text-white">
                                    <span id="answered">0</span>
                                </div>
                                Answered
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="type m-2 px-3 py-2">
                                    <span id="notvisided">0</span>
                                </div>
                                Not Visited
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="type m-2 px-3 py-2 bg-danger text-white">
                                    <span id="visited">0</span>
                                </div>
                                Visited Not Answered
                            </div>
                        </div>
                        <div class="no-series d-flex justify-content-evenly align-items-center">
                            @for ($i = 0; $i < $count; $i++)
                                <a onclick="showQuestion({{ $i + 1 }})"
                                    class="type text-decoration-none m-2 px-3 py-2" style="color:{{$i?'black':'white'}};background:{{$i?'':'#e04943'}}"
                                    id="btn{{ $i + 1 }}">
                                    {{ $i + 1 }}
                                </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <button class="btn btn-primary mb-5" onclick="confirm('You want to SUBMIT your TEST')"><b>SUBMIT
                        TEST</b></button>
                <input type="hidden" name="count" value="{{ $count }}">
                <input type="hidden" name="test_id" value="{{ $test->test_id }}">
                <button id="submit" hidden><b>SUBMIT</b></button>
            </div>
        </div>
    </form>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date().getTime() + 1000 * 60 * {{ $test->duration }}; // timer in minutes

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
            var distance = {{ $a }} - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="timer"
            document.getElementById("timer").innerHTML = "Time left : " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "EXPIRED";
                document.getElementById("submit").click();
            }
        }, 1000);

        // Add a variable to keep track of answered questions
        var answeredQuestions = [];

        function showQuestion(questionNumber) {
            // Hide all questions
            for (var i = 1; i <= totalQuestions; i++) {
                document.getElementById('question' + i).style.display = 'none';
            }

            // Show the selected question
            document.getElementById('question' + questionNumber).style.display = 'block';

            // Highlight the button based on whether the question is answered or not
            var btn = document.getElementById('btn' + questionNumber);
            if (answeredQuestions.includes(questionNumber)) {
                btn.style.backgroundColor = 'green';
                btn.style.color = 'white';
            } else {
                btn.style.backgroundColor = '#e04943'; // Set to default color when showing the question
                btn.style.color = 'white';

            }
        }

        // Function to update answeredQuestions array when an option is selected
        function selectOption(questionNumber) {
            // Remove the question from the answeredQuestions array if it was selected and now deselected
            var index = answeredQuestions.indexOf(questionNumber);
            if (index !== -1) {
                answeredQuestions.splice(index, 1);
            }

            // Check if any option is selected for the current question
            var options = document.getElementsByName('option' + questionNumber);
            var optionSelected = false;

            for (var i = 0; i < options.length; i++) {
                if (options[i].checked) {
                    optionSelected = true;
                    break;
                }
            }

            // Update the button color based on whether an option is selected or not
            var btn = document.getElementById('btn' + questionNumber);
            btn.style.backgroundColor = optionSelected ? 'green' : '#e04943';
            btn.style.color = 'white';
            ({{ $count }} == questionNumber) ? '' : showQuestion(questionNumber + 1);
            if (optionSelected) {
                answeredQuestions.push(questionNumber);
            }
        }

        // Rest of the countdown timer code remains unchanged

        // Set the total number of questions
        var totalQuestions = {{ $count }}; // Change this to the total number of questions
    </script>
@endsection
