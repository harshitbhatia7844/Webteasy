@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Questions</h1>

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
                            <th>Select</th>
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
                        <form action="{{ route('admin.savetq') }}" method="post">
                            @csrf
                            <input class="form-control" type="text" name="tid" id="">
                            @foreach ($items as $item)
                                <tr>
                                    <td><input class="form-control" type='checkbox' name='qid'
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
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
