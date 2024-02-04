@extends('layout.mainlayout')
@section('content')
    <img src="{{ asset('images/logo.png')}}" alt="" style="height: 10rem">
    <h2 class="fw-bold my-3 text-uppercase text-white">Webteasy Quiz Application</h2>
    <p class="text-white mb-3">Welcome to Our Home Page!</p>
    <a class="btn btn-outline-light btn-lg px-5 w-75 my-4 p-3" role="button" href={{ route('student.login') }}>
        Student Login
    </a>
    <a class="btn btn-outline-light btn-lg px-5 w-75 my-4 p-3" role="button" href={{ route('admin.login') }}>
        Admin Login
    </a>
@endsection
