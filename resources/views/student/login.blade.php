@extends('layout.mainlayout')
@section('content')
    <div class="mb-md-5 mt-md-4 pb-5">
        <img src="{{ asset('images/logo.png')}}" alt="" style="height: 10rem">
        <h2 class="fw-bold my-2 text-uppercase text-info">Student Login</h2>
        <p class="text-white-50 mb-5">Please enter your login and password!</p>
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
        <form action="{{ route('student.signin') }}" method="post">
            @csrf
            <div class="form-outline form-white mb-4">
                <input type="email" id="typeroll_noX" placeholder="Email" class="form-control form-control-lg"
                    name="email" />
                {{-- <label class="form-label" for="typeroll_noX">Email</label> --}}
            </div>

            <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" placeholder="Password" class="form-control form-control-lg"
                    name="password" />
                {{-- <label class="form-label" for="typePasswordX">Password</label> --}}
            </div>

            <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
        </form>
    </div>
    <div class="d-flex justify-content-evenly">
        <p class="small"><a class="text-white-50" href="{{ route('student.register') }}">Create
                an account</a></p>
        <p class="small mb-2"><a class="text-white-50" href="{{ route('student.forgetpassword') }}">Forget Password</a>
        </p>
    </div>
    <div>
        <p class="small mb-3 pb-lg-2"><a class="text-white-50" href="{{ route('welcome') }}">&larr; Back to Home</a></p>
    </div>

@endsection
