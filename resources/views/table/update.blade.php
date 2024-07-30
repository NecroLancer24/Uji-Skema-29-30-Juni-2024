@extends('layout.app')

@section('title')
    Update User
@endsection

@section('content')
    <div class="container mt-5">
        <div class="card">
            <h1 class="card-title text-center">Update Data</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('update', $data->id) }}" method="post">
                    @csrf
                    <label for="Name">Name</label>
                    <input type="text" name="name" id="Name" class="form-control" value="{{ $data->name }}">
                    <label for="Email">Email</label>
                    <input type="email" name="email" id="Email" class="form-control" value="{{ $data->email }}">
                    <label for="Password">Password</label>
                    <input type="password" name="password" id="Password" class="form-control">
                    <label for="Password">Isi form di atas jika ingin ubah password</label>
                    <select name="role" class="form-select mt-3" >
                        <option selected hidden value="{{ $data->role_id }}">{{ $data->role->role_name }}</option>
                        @foreach ($role as $item)
                            <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                        @endforeach
                    </select>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
