@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Questions</h1>
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
    <form action="" class="d-md-flex" method="get">
        <select name="test_id" class="form-control form-control-lg my-3 w-75">
            <option value="">All Tests</option>
            @foreach ($tests as $test)
                <option value="{{ $test->test_id }}" {{ $test->test_id == ($test_id ?? '') ? 'selected' : '' }}>
                    {{ $test->name }}
                    on {{ $test->date }}</option>
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
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr id="{{ $item->id }}">
                                <td>{{ $count++ }}</td>
                                <td>{{ $item->question }}</td>
                                <td class="{{ $item->answer == 'a' ? 'text-success' : '' }}">{{ $item->a }}</td>
                                <td class="{{ $item->answer == 'b' ? 'text-success' : '' }}">{{ $item->b }}</td>
                                <td class="{{ $item->answer == 'c' ? 'text-success' : '' }}">{{ $item->c }}</td>
                                <td class="{{ $item->answer == 'd' ? 'text-success' : '' }}">{{ $item->d }}</td>
                                <td hidden>{{ $item->answer }}</td>
                                <td><a href="#" onclick="on({{ $item->id }})"><i
                                            class="fas fa-edit fa-lg fa-fw"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <div id="overlay">
        <div class="form-content-1">
            <button class="cross" onclick="off()">X</button>
            <b>
                <h3>Update Question</h3>
            </b>
            <form action="{{ route('admin.updatequestion') }}" method="post">
                @csrf
                <div class="big-1">
                    <input type="text" name="question" placeholder="Question" value="" />
                    <div class="small-1">
                        <input type="text" name="a" placeholder="Option A" value="" />
                        <input type="text" name="b" placeholder="Option B" value="" />
                    </div>
                    <div class="small-1">
                        <input type="text" name="c" placeholder="Option C" value="" />
                        <input type="text" name="d" placeholder="Option D" value="" />
                    </div>
                    <div class="small-1">
                        <input type="text" name="answer" placeholder="Answer" value="" />
                    </div>
                    <input type="text" name="id" value="" hidden />
                    <button class="btn5-1" href="#">Submit +</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function on(id) {
            document.getElementById("overlay").style.display = "flex";
            a = document.getElementById(id).childNodes;
            document.getElementsByName("id")[0].value = id;
            document.getElementsByName("question")[0].value = a[3].innerHTML;
            document.getElementsByName("a")[0].value = a[5].innerHTML;
            document.getElementsByName("b")[0].value = a[7].innerHTML;
            document.getElementsByName("c")[0].value = a[9].innerHTML;
            document.getElementsByName("d")[0].value = a[11].innerHTML;
            document.getElementsByName("answer")[0].value = a[13].innerHTML;
        }

        function off() {
            document.getElementById("overlay").style.display = "none";
        }
    </script>
@endsection
