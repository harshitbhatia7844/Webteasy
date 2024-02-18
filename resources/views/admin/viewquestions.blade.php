@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Questions</h1>

    <form action="" class="d-md-flex" method="get">
        <select name="test_id" class="form-control form-control-lg my-3 w-75">
            <option value="">All Tests</option>
            @foreach ($tests as $test)
                <option value="{{$test->test_id}}">{{$test->name}} on {{$test->date}}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-primary m-3" type="submit">Filter by Test</button>
    </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Questions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Question</th>
                            <th>Option A</th>
                            <th>Option B</th>
                            <th>Option C</th>
                            <th>Option D</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->question }}</td>
                            <td class="{{ $item->answer == 'a' ? 'text-success' : '' }}">{{ $item->a }}</td>
                            <td class="{{ $item->answer == 'b' ? 'text-success' : '' }}">{{ $item->b }}</td>
                            <td class="{{ $item->answer == 'c' ? 'text-success' : '' }}">{{ $item->c }}</td>
                            <td class="{{ $item->answer == 'd' ? 'text-success' : '' }}">{{ $item->d }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
