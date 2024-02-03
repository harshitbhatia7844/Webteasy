@extends('layout.quizlayout')
@section('content')
    <form action="{{ route('student.result') }}" method="post">
        @csrf
        <nav class="navbar bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">
                    Online Quiz System
                </a>
            </div>
        </nav>
        <div class="container mt-3">
            <div class="header">
                <div class="navbar">
                    <h1>Course : BTECH-CSE</h1>
                    {{-- <button class="btn btn-primary">Submit Test</button> --}}
                </div>
                <div class="navbar px-3 m-4">
                    <h3>Paper : Test1-Mix Test</h3>
                    <h6 id="demo"></h6>
                </div>
            </div>
            <div class="content d-flex justify-content-center">
                <div class="content-1">
                    <div class="ques overflow-y">

                        <div class="d-flex" id="1">
                            <div class="ques-no m-2 px-2 py-1">
                                1
                            </div>
                            <div class="marks m-2 px-2 py-1">
                                Marks: +1
                            </div>
                            <div class="type m-2 px-2 py-1">
                                Type: MCQ
                            </div>
                        </div>
                        <div class="question my-3">
                            <h3>Q: 1</h3>
                        </div>
                        <div class="options">
                            <div class="optn my-3">
                                <label class="w-100 d-flex align-items-center" for="option1">
                                    <div class="op">1</div>
                                    a
                                </label>
                                <input class="form-check-input me-2" type="radio" name="option1" id="option1"
                                    value="1">
                            </div>
                            <div class="optn my-3">
                                <label class="w-100 d-flex align-items-center" for="option1">
                                    <div class="op">2</div>
                                    b
                                </label>
                                <input class="form-check-input me-2" type="radio" name="option1" id="option1"
                                    value="2">
                            </div>
                            <div class="optn my-3">
                                <label class="w-100 d-flex align-items-center" for="option1">
                                    <div class="op">3</div>
                                    c
                                </label>
                                <input class="form-check-input me-2" type="radio" name="option1" id="option1"
                                    value="3">
                            </div>
                            <div class="optn my-3">
                                <label class="w-100 d-flex align-items-center" for="option1">
                                    <div class="op">4</div>
                                    d
                                </label>
                                <input class="form-check-input me-2" type="radio" name="option1" id="option1"
                                    value="4">
                            </div>
                            <input class="form-check-input me-2" type="radio" name="option1" id="option1" value="0"
                                checked hidden>
                        </div>
                    </div>
                    <div class="ques-series">
                        <div class="ans-series">
                            <div class="ans-series-1">
                                <div class="box m-2 px-3 py-2 bg-success text-white">
                                    0
                                </div>
                                Answered
                            </div>
                            <div class="ans-series-1">
                                <div class="box m-2 px-3 py-2 bg-secoundry">
                                    0
                                </div>
                                Not Answered
                            </div>
                            <div class="ans-series-1">
                                <div class="box m-2 px-3 py-2 bg-warning">
                                    0
                                </div>
                                Marked for Review
                            </div>
                        </div>
                        <div class="no-series d-flex">

                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <button class="btn btn-primary" onclick="confirm('You want to SUBMIT your TEST')"><b>SUBMIT TEST</b></button>
                <button id="submit" hidden><b>SUBMIT</b></button>
            </div>
        </div>
    </form>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date().getTime() + 1000 * 60 * 2 * 5;

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            var distance = countDownDate - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                document.getElementById("submit").click();
            }
        }, 1000);
    </script>
@endsection
