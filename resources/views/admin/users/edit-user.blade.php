@extends('layout.layout')
@section('page-header')
    <x-page-header title="Edit user" />
@endsection
@section('content')
    <div class="card card-primary">


        <form action="{{ route('user.update', [$user]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Name" value="{{ $user->name }}" />
                </div>

                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Email" value="{{ $user->email }}" />
                </div>

                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="password" value="" />
                </div>

                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" placeholder="Phone" value="{{ $user->phone }}" />

                </div>

                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" placeholder="address" value="{{ $user->address }}" />
                </div>

                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="user" name="role" class="custom-control-input">
                        <label class="custom-control-label" for="user">User</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="admin" name="role" class="custom-control-input">
                        <label class="custom-control-label" for="admin">Admin</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-8">
                        <label for="image">image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                            name="image" placeholder="image" />
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('storage/' . $user->image) }}" style="width: 150px; height: 150px;"
                            alt="User profile">
                    </div>
                </div>

                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

            </div>


            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
