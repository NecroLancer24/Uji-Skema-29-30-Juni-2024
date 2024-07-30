@extends('layout.app')

@section('title')
    Login
@endsection

@section('content')
    <div class="container">


            <div class="card">
                <h1 class="card-title text-center">Login</h1>
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('Login') }}" method="post">
                        @csrf
                        <label for="Email">Email</label>
                        <input type="email" name="email" id="Email" class="form-control">
                        <label for="Password">Password</label>
                        <input type="password" name="password" id="Password" class="form-control">
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
