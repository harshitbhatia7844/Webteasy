@extends('layout.mainlayout')
@section('content')
    <form action={{ route('student.reset') }} method="post">
        @csrf
        <div class="mb-md-5 mt-md-4 pb-5">
            <img src="../images/logo.png" alt="" style="height: 10rem">
            <h2 class="fw-bold my-3 pb-5 text-uppercase text-info">Reset Password</h2>
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
                <input type="email" id="typeEmailX" placeholder="Email" class="form-control form-control-lg"
                    name="email" />
                <label class="form-label" for="typeEmailX">Email</label>
            </div>
            <div class="form-outline form-white mb-4">
                <input type="date" id="typeolddobX" placeholder="DOB" class="form-control form-control-lg"
                    name="dob" />
                <label class="form-label" for="typedobX">DOB</label>
            </div>
            <div class="form-outline form-white mb-4">
                <input type="password" id="typenewPasswordX" placeholder="New Password" class="form-control form-control-lg"
                    name="newpassword" />
                <label class="form-label" for="typenewPasswordX">New Password</label>
            </div>
            <button class="btn btn-outline-light btn-lg px-5" type="submit">Reset
                Password</button>
        </div>
        <div>
            <p class="mb-0">Don't have an account? <a href={{ route('student.register') }}
                    class="text-white-50 fw-bold">Sign Up</a>
            <p class="mb-0">Already have an account? <a href={{ route('student.login') }}
                    class="text-white-50 fw-bold">Login</a>
            </p>
        </div>
    </form>
@endsection
