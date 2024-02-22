@extends('layout.adminlayout')
@section('content')
    <h1 class="text-primary">View Students</h1>
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
        <select name="course" id="course" class="form-control form-control-lg m-3 w-25">
            <option value="">All Branch</option>
            <option value="BTECH" {{ 'BTECH' == ($course ?? '') ? 'selected' : '' }}>BTECH</option>
            <option value="BCA" {{ 'BCA' == ($course ?? '') ? 'selected' : '' }}>BCA</option>
            <option value="MCA" {{ 'MCA' == ($course ?? '') ? 'selected' : '' }}>MCA</option>
            <option value="Diploma" {{ 'Diploma' == ($course ?? '') ? 'selected' : '' }}>Diploma</option>
        </select>
        <select name="branch" id="branch" class="form-control form-control-lg m-3 w-25">
            <option value="{{ $branch ?? '' }}">{{ $branch ?? 'All Course' }}</option>
        </select>
        <select name="semester" class="form-control form-control-lg m-3 w-25">
            <option value="">All Semester</option>
            <option value="1" {{ '1' == ($semester ?? '') ? 'selected' : '' }}>1st Semester</option>
            <option value="2" {{ '2' == ($semester ?? '') ? 'selected' : '' }}>2nd Semester</option>
            <option value="3" {{ '3' == ($semester ?? '') ? 'selected' : '' }}>3rd Semester</option>
            <option value="4" {{ '4' == ($semester ?? '') ? 'selected' : '' }}>4th Semester</option>
            <option value="5" {{ '5' == ($semester ?? '') ? 'selected' : '' }}>5th Semester</option>
            <option value="6" {{ '6' == ($semester ?? '') ? 'selected' : '' }}>6th Semester</option>
            <option value="7" {{ '7' == ($semester ?? '') ? 'selected' : '' }}>7th Semester</option>
            <option value="8" {{ '8' == ($semester ?? '') ? 'selected' : '' }}>8th Semester</option>
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
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr id="{{ $item->id }}">
                                <td>{{ $count++ }}</td>
                                <td>{{ $item->roll_no }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile_no }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->course }}</td>
                                <td>{{ $item->branch }}</td>
                                <td>{{ $item->semester }}</td>
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
                <h3>Update Student</h3>
            </b>
            <form action="{{ route('admin.updatestudent') }}" method="post">
                @csrf
                <div class="small-1">
                    <input type="text" name="roll_no" placeholder="Roll No" value="" />
                    <input type="text" name="name" placeholder="Your Name" value="" />
                </div>
                <div class="big-1">
                    <input type="email" name="email" placeholder="Email Address" value="" />
                    <div class="small-1">
                        <input type="text" name="mobile_no" placeholder="Phone Number" value="" minlength="10"
                            maxlength="10" />
                        <input type="text" name="gender" placeholder="Gender" value="" />
                    </div>
                    <div class="small-1">
                        <input type="text" name="course1" placeholder="Course" value="" />
                        <input type="text" name="branch1" placeholder="Branch" value="" />
                    </div>
                    <div class="small-1">
                        <input type="text" name="semester1" placeholder="Semester" value="" />
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
            document.getElementsByName("roll_no")[0].value = a[3].innerHTML;
            document.getElementsByName("name")[0].value = a[5].innerHTML;
            document.getElementsByName("email")[0].value = a[7].innerHTML;
            document.getElementsByName("mobile_no")[0].value = a[9].innerHTML;
            document.getElementsByName("gender")[0].value = a[11].innerHTML;
            document.getElementsByName("course1")[0].value = a[13].innerHTML;
            document.getElementsByName("branch1")[0].value = a[15].innerHTML;
            document.getElementsByName("semester1")[0].value = a[17].innerHTML;
        }

        function off() {
            document.getElementById("overlay").style.display = "none";
        }

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
