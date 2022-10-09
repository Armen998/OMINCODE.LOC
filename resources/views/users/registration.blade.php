<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Omnicode</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/auth.css">
</head>
<body>
    <div class="d-flex">
        <div class="col-12 col-md-8">
            <div class="d-flex justify-content-center align-items-center w-100 aaa mx-auto">
                <img src="{{ asset('/storage/icon/omnicode.png') }}" class="w-95" </div>
            </div>
        </div>
        <div class="col-12 col-md-4 d-flex ">
            @csrf
            @if (session()->has('failure'))
            <div class="alert alert-danger" role="alert"> {{ session()->get('failure') }} </div>
            @endif
            <form method="POST" action="{{ route('signup') }}" class=" mr-auto my-auto w-75">
                <img src="{{ asset('/storage/icon/registration.png') }}" class=" w-100" </div>
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
                <div>
                    <button type="submit" class="btn btn-info">Register</button>
                    <a class="text-info ml-3 font-italic" href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
