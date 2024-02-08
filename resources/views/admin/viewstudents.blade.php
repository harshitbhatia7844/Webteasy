@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Students</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Students</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Roll No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Gender</th>
                            <th>Course</th>
                            <th>Branch</th>
                            <th>Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->roll_no }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile_no }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->course }}</td>
                                <td>{{ $item->branch }}</td>
                                <td>{{ $item->semester }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $items->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
