@extends('layout.studentlayout')

@section('content')
    @if ($activeTest)
        <h1 class="text-primary">Active Test</h1>
        <div class="card" style="border: none;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <div class="card-header">
                <h3 class="fw-bold text-center">{{ $activeTest->name }}</h3>
            </div>
            <div class="card-body text-center">
                <p><strong>Date:</strong> {{ $activeTest->date }}</p>
                <p><strong>Duration:</strong> {{ $activeTest->duration }} minutes</p>
                <p><strong>Start Time:</strong> {{ $activeTest->start_time }}</p>
                <p><strong>End Time:</strong> {{ $activeTest->end_time }}</p>
                <a href="#" class="btn btn-primary">Start Quiz</a>
            </div>
        </div>
    @else
        <p>No active test found.</p>
    @endif
@endsection

{{-- <div >
    <div class="card-header">
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title">Special title treatment</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div> --}}
