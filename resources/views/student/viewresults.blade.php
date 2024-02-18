@extends('layout.studentlayout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="text-primary">View Results</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Results</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Test Name</th>
                            <th>Date </th>
                            <th>Total Questions</th>
                            <th>Attempted</th>
                            <th>Right Answers</th>
                            <th>Total Score</th>
                            <th>Analytics</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->date }}</td>
                                <td>{{ $item->no_of_questions }}</td>
                                <td>{{ $item->attemted }}</td>
                                <td>{{ $item->correct }}</td>
                                <td>{{ $item->total_score }}</td>
                                <td><a href="{{route('student.analytics')}}?test_id={{ $item->test_id }}">Analytics</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
