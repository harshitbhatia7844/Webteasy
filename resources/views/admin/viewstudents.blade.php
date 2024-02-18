@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Students</h1>

    <form action="" class="d-md-flex" method="get">
        <select name="course" id="course" class="form-control form-control-lg m-3 w-25">
            <option value="">All Branch</option>
            <option value="BTECH">BTECH</option>
            <option value="BCA">BCA</option>
            <option value="MCA">MCA</option>
            <option value="Diploma">Diploma</option>
        </select>
        <select name="branch" id="branch" class="form-control form-control-lg m-3 w-25">
            <option value="">All Course</option>
        </select>
        <select name="semester" class="form-control form-control-lg m-3 w-25">
            <option value="">All Semester</option>
            <option value="1">1st Semester</option>
            <option value="2">2nd Semester</option>
            <option value="3">3rd Semester</option>
            <option value="4">4th Semester</option>
            <option value="5">5th Semester</option>
            <option value="6">6th Semester</option>
            <option value="7">7th Semester</option>
            <option value="8">8th Semester</option>
        </select>
        <button class="btn btn-outline-primary m-3" type="submit">Filter by Test</button>
    </form>
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
    <script>
        function getType() {
            var x = document.getElementById("course").value;
            var items;
            if (x === "BTECH") {
                items = ["CSE", "CS with DS", "CS with Security", "CS with Animation"];
            } else if (x === "BCA") {
                items = ["BCA"]
            } else if (x === "MCA") {
                items = ["MCA"]
            } else if (x === "Diploma") {
                items = ["CS", "EE", "EC", "ME", "CE"]
            }
            var str = "<option value='' default hidden>Select</option>"
            for (var item of items) {
                str += "<option value='" + item + "'>" + item + "</option>"
            }
            document.getElementById("branch").innerHTML = str;
        }
        document.getElementById("course").addEventListener("change", getType);
    </script>
@endsection
