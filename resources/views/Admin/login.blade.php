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
            <form method="POST" action="{{ route('admin.signin') }}" class=" mr-auto my-auto w-75">
                <img src="{{ asset('/storage/icon/admin.png') }}" class=" w-100" </div>
                <img src="{{ asset('/storage/icon/login.png') }}" class=" w-100" </div>
                @csrf
                <div class="col-12 col-mb-6 ">
                    @csrf
                    @if (session()->has('thank'))
                    <div class="alert alert-success" role="alert"> {{ session()->get('thank') }} </div>
                    @endif
                    @if (session()->has('suspension'))
                    <div class="alert  alert-danger" role="alert"> {{ session()->get('suspension') }} </div>
                    @endif
                </div>
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
                    <label for="exampleInputPassword" class="form-label text-info font-italic">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword">
                </div>
                @error('password')
                <div class="alert alert-danger" role="alert">
                    <a href="#" class="alert-link">{{ $message }}</a>
                </div>
                @enderror
                <div>
                    <button type="submit" class="btn btn-info">Login</button>
                </div>
            </form>
        </div>
</body>
</html>
