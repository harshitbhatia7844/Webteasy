@extends('layout.studentlayout')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (session()->has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session()->get('success') }}</li>
            </ul>
        </div>
    @endif
    @if ($activeTests->isNotEmpty())
        <h1 class="text-primary">Active Tests</h1>
        @foreach ($activeTests as $activeTest)
            <div class="card border-0 shadow p-3 mb-5 bg-white rounded" id="testCard{{ $activeTest->test_id }}">
                <div class="card-header d-flex justify-content-between align-items-center"
                    id="testHeader{{ $activeTest->test_id }}">
                    <h3 class="fw-bold mb-0" id="testName{{ $activeTest->test_id }}">{{ $activeTest->name }}</h3>
                    @if ($activeTest->date == now()->toDateString())
                        <a href="{{ route('student.select') }}?test_id={{ $activeTest->test_id }}"
                            class="btn btn-primary start-quiz-btn" data-test-id="{{ $activeTest->test_id }}">Start
                            Quiz</a>
                    @elseif ($activeTest->date >= now()->toDateString())
                        <p class="btn btn-warning start-quiz-btn" data-test-id="{{ $activeTest->test_id }}">Upcomming</p>
                    @elseif ($activeTest->date <= now()->toDateString())
                        <p class="btn btn-danger start-quiz-btn" data-test-id="{{ $activeTest->test_id }}">Expired</p>
                    @endif
                </div>
                <div class="card-body d-flex justify-content-between" id="testBody{{ $activeTest->test_id }}"
                    style="display: none;">
                    <div class="d-flex">
                        <div class="info mr-5">
                            <p><strong>Date:</strong> <span
                                    id="testDate{{ $activeTest->test_id }}">{{ $activeTest->date }}</span></p>
                            <p><strong>Duration:</strong> <span
                                    id="testDuration{{ $activeTest->test_id }}">{{ $activeTest->duration }} minutes</span>
                            </p>
                        </div>
                        <div class="info">
                            <p><strong>Start Time:</strong> <span
                                    id="testStartTime{{ $activeTest->test_id }}">{{ $activeTest->start_time }}</span></p>
                            <p><strong>End Time:</strong> <span
                                    id="testEndTime{{ $activeTest->test_id }}">{{ $activeTest->end_time }}</span></p>
                        </div>
                    </div>
                    <div class="time">
                        @if ($activeTest->date == now()->toDateString())
                            <span id="timer{{ $activeTest->test_id }}"></span>
                        @elseif ($activeTest->date >= now()->toDateString())
                            <p data-test-id="{{ $activeTest->test_id }}">Upcomming</p>
                        @elseif ($activeTest->date <= now()->toDateString())
                            <p data-test-id="{{ $activeTest->test_id }}">Expired</p>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No active tests found.</p>
    @endif
@endsection

<script>
    // Function to update timer for a specific test
    function updateTimer(testId, startTime) {
        // Calculate remaining time until the test starts
        var timer = calculateTimer(startTime);

        // Update timer display
        document.getElementById("timer" + testId).textContent = timer;
    }

    // Call updateTimer function for each test on page load and every second
    window.onload = function() {
        @foreach ($activeTests as $activeTest)
            @if ($activeTest->date == now()->toDateString())
                var startTime{{ $activeTest->test_id }} = "{{ $activeTest->start_time }}";
                updateTimer({{ $activeTest->test_id }}, startTime{{ $activeTest->test_id }});
                setInterval(function() {
                    updateTimer({{ $activeTest->test_id }}, startTime{{ $activeTest->test_id }});
                }, 1000);
            @endif
        @endforeach
    };

    // Function to calculate remaining time until the test starts
    function calculateTimer(startTime) {
        var now = new Date();
        var testStart = new Date();

        testStart.setHours(parseInt(startTime.split(":")[0]), parseInt(startTime.split(":")[1]), 0);

        var remainingTime = testStart - now;

        // If remaining time is negative, it means the test has already started or it's in progress
        if (remainingTime <= 0) {
            return "Test in progress";
        } else {
            var hours = Math.floor(remainingTime / (1000 * 60 * 60));
            var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            return "Test starts after " + hours + ":" + minutes.toString().padStart(2, "0") + ":" + seconds.toString()
                .padStart(2, "0");
        }
    }
</script>
