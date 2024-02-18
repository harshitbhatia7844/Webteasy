@extends('layout.adminlayout')
@section('content')
    <h2 class="text-primary">Assign Questions to Test</h2>
    <form action="{{ route('admin.savetq') }}" method="post">
        @csrf
        <div class="d-flex">
            <select name="tid" class="form-control form-control-lg w-75 m-3" id="">
                @foreach ($tests as $test)
                    <option value="{{ $test->test_id }}">{{ $test->name }} on {{ $test->date }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary m-3" type="submit">Submit</button>
        </div>
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
                                <th><i class="fa fa-check-square" aria-hidden="true"></i></th>
                                <th>S.No</th>
                                <th>Question</th>
                                <th>Option A</th>
                                <th>Option B</th>
                                <th>Option C</th>
                                <th>Option D</th>
                                <th>Answer</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($items as $item)
                                <tr>
                                    <td><input class="form-control m-1" type='checkbox' name='qid[]'
                                            value='{{ $item->id }}' /></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->question }}</td>
                                    <td>{{ $item->a }}</td>
                                    <td>{{ $item->b }}</td>
                                    <td>{{ $item->c }}</td>
                                    <td>{{ $item->d }}</td>
                                    @if ($item->answer == 'a')
                                        <td>{{ $item->a }}</td>
                                    @elseif($item->answer == 'b')
                                        <td>{{ $item->b }}</td>
                                    @elseif($item->answer == 'c')
                                        <td>{{ $item->c }}</td>
                                    @else
                                        <td>{{ $item->d }}</td>
                                    @endif
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $items->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </form>
@endsection
