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
                            <th>S.No</th>
                            <th>Question</th>
                            <th>Option A</th>
                            <th>Option B</th>
                            <th>Option C</th>
                            <th>Option D</th>
                            <th>Response</th>
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
                                <td class="{{ $item->s_answer ? $item->s_answer == $item->answer ? 'text-success' : 'text-danger' : ''}}">
                                    @if ($item->s_answer == '0')
                                        N/A
                                    @elseif($item->s_answer == 'a')
                                        {{ $item->a }}
                                    @elseif($item->s_answer == 'b')
                                        {{ $item->b }}
                                    @elseif($item->s_answer == 'c')
                                        {{ $item->c }}
                                    @elseif($item->s_answer == 'd')
                                        {{ $item->d }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
