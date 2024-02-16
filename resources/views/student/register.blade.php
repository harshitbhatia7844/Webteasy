@extends('layout.mainlayout')
@section('content')
    <form action="{{ route('student.signup') }}" method="post">
        @csrf
        <div class="mb-md-5 mt-md-4 pb-5">
            <img src="{{ asset('images/logo.png')}}" alt="" style="height: 10rem">
            <h2 class="fw-bold mb-4 text-uppercase text-info">Student Register</h2>
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
            <div class="form-outline form-white mb-4">
                <input type="text" id="typerollX" placeholder="Muit Roll No." class="form-control form-control-lg"
                    name="roll_no" />
                <!-- <label class="form-label" for="typerollX">Roll NO.</label> -->
            </div>
            <div class="form-outline form-white mb-4">
                <input type="text" id="typeNameX" placeholder="Name" class="form-control form-control-lg"
                    name="name" />
                <!-- <label class="form-label" for="typeNameX">Name</label> -->
            </div>
            <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" placeholder="Email" class="form-control form-control-lg"
                    name="email" />
                <!-- <label class="form-label" for="typeEmailX">Email</label> -->
            </div>

            <div class="form-outline form-white mb-4">
                <input type="text" id="typeMobileX" placeholder="Mobile No." class="form-control form-control-lg"
                    name="mobile_no" minlength="10" maxlength="10"/>
                <!-- <label class="form-label" for="typeMobileX">Mobile NO.</label> -->
            </div>

            <div class="form-outline form-white mb-4">
                <select name="course" onchange="getType" id="course" class="form-control form-control-lg">
                    <option default hidden>Select Course</option>
                    <option value="BTECH">BTECH</option>
                    <option value="BCA">BCA</option>
                    <option value="MCA">MCA</option>
                    <option value="Diploma">Diploma</option>
                </select>
            </div>

            <div class="form-outline form-white mb-4">
                <select name="branch" id="branch" class="form-control form-control-lg">
                    <option default hidden>Select Branch</option>
                </select>
            </div>

            <div class="form-outline form-white mb-4">
                <select name="semester" id="" class="form-control form-control-lg">
                    <option default hidden>Select Semester</option>
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                    <option value="3">3rd Semester</option>
                    <option value="4">4th Semester</option>
                    <option value="5">5th Semester</option>
                    <option value="6">6th Semester</option>
                    <option value="7">7th Semester</option>
                    <option value="8">8th Semester</option>
                </select>
            </div>

            <div class="form-outline form-white mb-4">
                <input type="date" id="typedobX" placeholder="DOB" class="form-control form-control-lg"
                    name="dob" />
                <!-- <label class="form-label" for="typedobX">DOB</label> -->
            </div>

            <div class="form-outline form-white mb-4">
                <select name="gender" id="" class="form-control form-control-lg">
                    <option default hidden>Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" placeholder="Password" class="form-control form-control-lg"
                    name="password" />
                <!-- <label class="form-label" for="typePasswordX">Password</label> -->
            </div>

            <div class="form-outline form-white mb-4">
                <input type="password" id="typepassword_confirmationX" placeholder="Confirm Password"
                    class="form-control form-control-lg" name="password_confirmation" />
                <!-- <label class="form-label" for="typePasswordX">Password</label> -->
            </div>
            <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
        </div>

        <div>
            <p class="mb-0">Already have an account? <a href="{{ route('student.login') }}"
                    class="text-white-50 fw-bold">Login</a>
            </p>
        </div>
    </form>
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
            var str = "<option default hidden>Select</option>"
            for (var item of items) {
                str += "<option value='" + item + "'>" + item + "</option>"
            }
            document.getElementById("branch").innerHTML = str;
        }
        document.getElementById("course").addEventListener("change", getType);
    </script>
@endsection