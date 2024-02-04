@extends('layout.mainlayout')
@section('content')
    <form action="{{ route('admin.signin') }}" method="post">
        @csrf
        <div class="mb-md-5 mt-md-4 pb-5">
            <img src="{{ asset('images/logo.png')}}" alt="" style="height: 10rem">
            <h2 class="fw-bold my-3 text-uppercase text-info">Admin Login</h2>
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
            <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" placeholder="Email" class="form-control form-control-lg"
                    name="email" />
                <!-- <label class="form-label" for="typeEmailX">Email</label> -->
            </div>

            <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" placeholder="Password" class="form-control form-control-lg"
                    name="password" />
                <!-- <label class="form-label" for="typePasswordX">Password</label> -->
            </div>
            <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
        </div>
        <div>
            <p class="small mb-2 pb-lg-2"><a class="text-white-50" href="{{ route('welcome') }}">&larr; Back to Home</a></p>
        </div>
    </form>
@endsection
