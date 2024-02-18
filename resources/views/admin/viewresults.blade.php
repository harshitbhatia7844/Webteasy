@extends('layout.adminlayout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="text-primary">View Results</h1>
        <a href="{{ route('admin.download-pdf') }}?test_id={{$test_id??''}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Download Result</a>
    </div>

    <form action="" class="d-md-flex" method="get">
        <select name="test_id" class="form-control form-control-lg my-3 w-75">
            <option value="">All Tests Results</option>
            @foreach ($tests as $test)
                <option value="{{$test->test_id}}">{{$test->name}} on {{$test->date}}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-primary m-3" type="submit">Filter by Test</button>
    </form>
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
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Total Score</th>
                            <th>Analytics</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->roll_no }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->total_score }}</td>
                                <td><a href="{{route('admin.analytics')}}?student_id={{ $item->roll_no }}&test_id={{ $item->test_id }}">Analytics</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
