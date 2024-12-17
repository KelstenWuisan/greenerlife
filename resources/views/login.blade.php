@extends('layout.mainlayout')
@section('title', 'Login')
@section('content')

<style>
    body {
        background-image: url('{{ asset('images/LoginFrog.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: flex-start; /* Align left */
        align-items: center; /* Align vertically in the center */
        margin: 0;
    }

    .login-box {
        background-color: transparent; /* No background */
        padding: 30px;
        border-radius: 8px;
        width: 100%;
        max-width: 500px;
        margin-left: 40px; /* Slightly to the right */
        color: white; /* Text color white */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.7); /* Slightly transparent background for inputs */
        color: black;
    }

    .btn-primary {
        background-color: #75af48;
        border-color: #285615;
    }

    .btn-primary:hover {
        background-color: #285615;
        border-color: #75af48;
    }

    .btn-google {
        background-color: white; /* Google red */
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
    }

    .btn-google img {
        width: 20px;
        margin-right: 10px;
    }

    .text-center {
        text-align: center;
    }

    .text-white {
        color: white;
    }

    .link {
        color: #007bff;
        text-decoration: none;
    }

    .link:hover {
        text-decoration: underline;
    }
</style>

<div class="login-box">
    <h2 class="text-center text-white">Login</h2>
    <div class="mb-3">
        @if($errors->any())
            <div class="col-12">
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
    </div>

    <form action="{{ route('login.post') }}" method="POST">   
        @csrf
        <div class="form-group mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>

    <!-- Create a new account link -->
    <div class="mt-3 text-center">
        <p class="text-white">
            Don't have an account? <a href="{{ route('registration') }}" class="link">Create a new account</a>
        </p>
    </div>
</div>

@endsection
