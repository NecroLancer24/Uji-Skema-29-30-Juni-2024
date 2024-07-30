@extends('layout.app')

@section('title')
    Table
@endsection

@section('content')
    <nav class="navbar navbar-expand-sm bg-body-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">{{ Auth::user()->name }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    @if (Auth::user()->role_id == '1')
                        <a class="nav-link" href="{{ route('register') }}">Add User</a>
                    @endif
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                @if (Auth::user()->role_id == 1)
                    <div class="alert alert-primary mt-3">
                        Anda Login Sebagai Admin
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success mt-3">
                        {{ Session::get('success') }}
                    </div>
                @elseif (Session::has('warning'))
                    <div class="alert alert-warning mt-3">
                        {{ Session::get('warning') }}
                    </div>
                @endif

                <form action="{{ route('home') }}" method="get">
                    <input type="search" name="katakunci" class="form-control" value="{{ Request::get('katakunci') }}"
                        placeholder="Masukkan input search">
                        <button class="btn btn-primary">Search</button>
                </form>

                <div class="table-reponsive">
                    <table class="table table-hover text-center">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            @if (Auth::user()->role_id == '1')
                                <th>Action</th>
                            @endif
                        </thead>
                        <tbody>
                            @php
                                $i = $data->FirstItem()
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role->role_name }}</td>
                                    @if (Auth::user()->role_id == '1')
                                        <td>
                                            <a href="{{ route('updateView', $item->id) }}">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>
                                            @if (Auth::user()->id != $item->id)
                                                <form action="{{ route('delete', $item->id) }}" method="post"
                                                    onsubmit="return confirm('Apakah Anda Yakin?')" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                                @php
                                    $i++
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
