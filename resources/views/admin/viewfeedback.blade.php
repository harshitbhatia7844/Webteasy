@extends('layout.adminlayout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="text-primary">View Results</h1>
    </div>
    <form action="" class="d-md-flex" method="get">
        <select name="test_id" class="form-control form-control-lg my-3 w-75">
            <option value="">All Tests</option>
            @foreach ($tests as $test)
                <option value="{{$test->test_id}}" {{($test->test_id==($test_id??''))?'selected':''}}>{{$test->name}} on {{$test->date}}</option>
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
                            <th>Student</th>
                            <th>Satisfy</th>
                            <th>Rating</th>
                            <th>Level</th>
                            <th>Suggestion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->satisfy }}</td>
                                <td>{{ $item->rating }}</td>
                                <td>{{ $item->level }}</td>
                                <td>{{ $item->suggestions }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
