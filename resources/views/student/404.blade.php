@extends('layout.studentlayout')

@section('content')
    @if ($activeTests->isNotEmpty())
        <h1 class="text-primary">Active Tests</h1>
        @foreach ($activeTests as $activeTest)
            <div class="card border-0 shadow p-3 mb-5 bg-white rounded" id="testCard{{ $activeTest->test_id }}">
                <div class="card-header d-flex justify-content-between align-items-center" id="testHeader{{ $activeTest->test_id }}">
                    <h3 class="fw-bold mb-0" id="testName{{ $activeTest->test_id }}">{{ $activeTest->name }}</h3>
                    <button class="btn btn-primary start-quiz-btn" data-test-id="{{ $activeTest->test_id }}">Start Quiz</button>
                </div>
                <div class="card-body d-flex justify-content-between" id="testBody{{ $activeTest->test_id }}" style="display: none;">
                    <div class="info">
                        <p><strong>Date:</strong> <span id="testDate{{ $activeTest->test_id }}">{{ $activeTest->date }}</span></p>
                        <p><strong>Duration:</strong> <span id="testDuration{{ $activeTest->test_id }}">{{ $activeTest->duration }} minutes</span></p>
                        <p hidden><strong>Start Time:</strong> <span id="testStartTime{{ $activeTest->test_id }}">{{ $activeTest->start_time }}</span></p>
                        <p hidden><strong>End Time:</strong> <span id="testEndTime{{ $activeTest->test_id }}">{{ $activeTest->end_time }}</span></p>
                    </div>
                    <div class="time">
                        <h3 id="timer{{ $activeTest->test_id }}"></h3>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No active tests found.</p>
    @endif

    <script>
        // Function to update timer for a specific test
        function updateTimer(testId) {
            var startTime = document.getElementById("testStartTime" + testId).textContent;
            var endTime = document.getElementById("testEndTime" + testId).textContent;

            // Calculate remaining time
            var timer = calculateTimer(startTime, endTime);

            // Update timer display
            document.getElementById("timer" + testId).textContent = timer;

            // If the test has ended, disable the start quiz button
            if (timer === "Test has ended") {
                document.getElementById("startQuizBtn" + testId).disabled = true;
            }
        }

        // Call updateTimer function for each test on page load and every second
        window.onload = function() {
            @foreach ($activeTests as $activeTest)
                updateTimer({{ $activeTest->test_id }});
                setInterval(function() { updateTimer({{ $activeTest->test_id }}); }, 1000);
            @endforeach
        };

        // Function to calculate remaining time
        function calculateTimer(start_time, end_time) {
            var now = new Date();
            var testStart = new Date();
            var testEnd = new Date();

            testStart.setHours(parseInt(start_time.split(":")[0]), parseInt(start_time.split(":")[1]), 0);
            testEnd.setHours(parseInt(end_time.split(":")[0]), parseInt(end_time.split(":")[1]), 0);

            if (now < testStart) {
                // Test has not started yet
                return "Test starts at " + start_time;
            } else if (now >= testEnd) {
                // Test has already ended
                return "Test has ended";
            } else {
                // Test is ongoing
                var remainingTime = testEnd - now;
                var hours = Math.floor(remainingTime / (1000 * 60 * 60));
                var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
                return hours + ":" + minutes.toString().padStart(2, "0") + ":" + seconds.toString().padStart(2, "0");
            }
        }
    </script>
@endsection

