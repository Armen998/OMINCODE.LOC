@extends('Admin.layout')

@section('content')
@if (session()->has('userRegistred'))
<div class="alert alert-success" role="alert"> {{ session()->get('userRegistred') }} </div>
@endif
@csrf
@if (session()->has('failure'))
<div class="alert alert-danger" role="alert"> {{ session()->get('failure') }} </div>
@endif
@if (session()->has('userNotRegistred'))
<div class="alert alert-danger" role="alert"> {{ session()->get('userNotRegistred') }} </div>
@endif
<div class="d-flex" style="margin-left: 15rem;">
    <div class="col-12  col-md-6 d-flex ">
        <div class="d-flex">
            <form method="POST" action="{{ route('admin.signup') }}" class=" mr-auto my-auto w-75" ">
                <img src=" {{ asset('/storage/icon/registration.png') }}" class=" w-100" </div>
                @csrf
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label text-info font-italic">Name</label>
                    <input name="name" type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" value="{{ old('name') }}">
                </div>
                @error('name')
                <div class="alert alert-danger" role="alert"> <a href="#" class="alert-link"> {{ $message }}
                    </a> </div>
                @enderror
                <div class="mb-3">
                    <label for="exampleInputAge" class="form-label text-info font-italic">Age</label>
                    <input name="age" type="number" class="form-control" id="exampleInputAge" aria-describedby="agelHelp" value="{{ old('age') }}">
                </div>
                @error('age')
                <div class="alert alert-danger" role="alert"> <a href="#" class="alert-link">{{ $message }}</a>
                </div>
                @enderror
                <div class="mb-3">
                    <label for="exampleInputEmail" class="form-label text-info font-italic">Email address</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="{{ old('email') }}">
                </div>
                @error('email')
                <div class="alert alert-danger" role="alert">
                    <a href="#" class="alert-link">{{ $message }}</a>
                </div>
                @enderror
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label text-info font-italic">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <a href="#" class="alert-link">{{ $message }}</a>
                </div>
                @enderror
                <div class="mb-3">
                    <label for="exampleInputPassword" class="form-label text-info font-italic">Repeat Password</label>
                    <input name="password_confirmation" type="password" class="form-control" id="exampleInputPassword2">
                </div>
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <a href="#" class="alert-link">{{ $message }}</a>
                </div>
                @enderror
                <p>Type</p>
                <div class="mb-3">
                    <input type="radio" class="btn-check" name="type" id="admin" autocomplete="off" value='admin'>
                    <label class="btn" for="admin">
                        <img style=" height: 40px; margin-right: 0px; margin-left: 0px;" src="{{ asset('/storage/icon/adminn.png') }}">
                    </label>
                    <input type="radio" class="btn-check" name="type" id="regular" autocomplete="off" value='regular'>
                    <label class="btn" for="regular">
                        <img style=" height: 40px; margin-right: 0px; margin-left: 0px;" src="{{ asset('/storage/icon/regular.png') }}">
                    </label>
                </div>
                @error('type')
                <div class="alert alert-danger" role="alert">
                    <a href="#" class="alert-link">{{ $message }}</a>
                </div>
                @enderror
                <div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
