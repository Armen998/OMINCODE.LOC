@extends('layout')

@section('content')
<div class="container">
    <table class="table">
        <tr>
            @if (auth('web')->user()->type === 'regular')
            <td> <a class="" href="{{ route('articles-create') }}"><i style="font-size:70px; width:5rem; color:blue " class="fa-regular fa-calendar-plus"></i></a></td>
            @endif
            @if (auth('web')->user()->avatar === null)
            <td> <a class="" href="{{ route('users-avatar-add') }}"> <i style="font-size:70px; width:5rem; color:rgb(170, 0, 255) " class="fa-regular fa-images"></i> </a> </td>
            @else
            <td>
                <button type="button" data-toggle="modal" data-target="#exampleModalCenter{{ auth('web')->id() }}"> <i style="font-size:70px; width:5rem; color: red ;" class="fa-regular fa-trash-can"> </i></button>
            </td>
            @endif
        </tr>
    </table>
    <div>
        <section style="background-color: rgb(243, 245, 230);">
            <div class="container my-10  py-12">
                <div class="row d-flex justify-content-center">
                    <div class="" style="background-color: rgb(243, 245, 235);">
                        <p class=" display-5 text-info font-italic text-center pb-3"> My Personal Data</p>
                        @if (session()->has('notChange'))
                        <div class="alert alert-danger" role="alert"> {{ session()->get('notChange') }} </div>
                        @endif
                        @if (session()->has('changed'))
                        <div class="alert alert-success" role="alert"> {{ session()->get('changed') }} </div>
                        @endif
                        <form method="POST" action="{{ route('users-update') }}">
                            @csrf
                            @method('PUT')
                            @error('name')
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="alert-link">{{ $message }}</a>
                            </div>
                            @enderror
                            <div class="row row pt-1 mt-6">
                                <div class="col-xs-6 col-md-3 ">
                                    <label for="exampleInputEmail1" class="form-label text-info font-italic " style="padding-top:3%;margin-left: 85%;">Name</label>
                                </div>
                                <div class="col-xs-6 col-md-6 ">
                                    <input name="name" type="text" class="form-control  " id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth('web')->user()->name }}">
                                </div>
                                <div class="col-xs-6 col-md-3 ">
                                    <button type="submit" class=" text-info font-italic" style="text-decoration: none; padding-top:3%;">Change</button>
                                </div>
                            </div>
                            @error('age')
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="alert-link">{{ $message }}</a>
                            </div>
                            @enderror
                            <div class="row pt-1  mt-6">
                                <div class="col-xs-6 col-md-3">
                                    <label for="exampleInputEmail1" class="form-label text-info font-italic" style=" padding-top:3%;margin-left: 90%;">Age</label>
                                </div>
                                <div class="col-xs-6 col-md-6 ">
                                    <input name="age" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{auth('web')->user()->age }}">
                                </div>
                                <div class="col-xs-6 col-md-3 ">
                                    <button type="submit" class=" text-info font-italic" style="text-decoration: none; padding-top:3%; ">Change</button>
                                </div>
                            </div>
                            @error('email')
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="alert-link">{{ $message }}</a>
                            </div>
                            @enderror
                            <div class="row row pt-1  mt-6">
                                <div class="col-xs-6 col-md-3 ">
                                    <label for="exampleInputEmail1" class="form-label text-info font-italic " style=" padding-top:3%; margin-left: 66%">Email address</label>
                                </div>
                                <div class="col-xs-6 col-md-6 ">
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth('web')->user()->email }}">
                                </div>
                                <div class="col-xs-6 col-md-3 ">
                                    <button type="submit" class=" text-info font-italic" style="text-decoration: none; padding-top:3%;">Change</button>
                                </div>
                            </div>
                        </form>
                        <p class=" display-6 pt-5  form-label text-info font-italic text-center"> Password Change</p>
                        <div>
                            @if (session()->has('passwordChanged'))
                            <div class="alert alert-success" role="alert"> {{ session()->get('passwordChanged') }} </div>
                            @endif
                            @if (session()->has('passwordnotChange'))
                            <div class="alert alert-danger" role="alert"> {{ session()->get('passwordnotChange') }} </div>
                            @endif
                            <form method="POST" action="{{ route('users-password-update') }}">
                                @csrf
                                @method('PUT')
                                @error('current_password')
                                <div class="alert alert-danger" role="alert">
                                    <a href="#" class="alert-link">{{ $message }}</a>
                                </div>
                                @enderror
                                <div class="row row pt-1  mt-6">
                                    <div class="col-xs-6 col-md-3 ">
                                        <label for="exampleInputPassword1" class="form-label text-info font-italic" style=" padding-top:3%; margin-left: 58%">Current Password</label>
                                    </div>
                                    <div class="col-xs-6 col-md-6 ">
                                        <input name="current_password" type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                </div>
                                @error('new_password')
                                <div class="alert alert-danger" role="alert">
                                    <a href="#" class="alert-link">{{ $message }}</a>
                                </div>
                                @enderror
                                <div class="row row pt-1  mt-6">
                                    <div class="col-xs-6 col-md-3 ">
                                        <label for="exampleInputPassword1" class="form-label text-info font-italic" style=" padding-top:3%; margin-left: 65%">New Password</label>
                                    </div>
                                    <div class="col-xs-6 col-md-6 ">
                                        <input name="new_password" type="password" class="form-control" id="exampleInputPassword1">
                                    </div>
                                </div>
                                @error('confirm_new_password')
                                <div class="alert alert-danger" role="alert">
                                    <a href="#" class="alert-link">{{ $message }}</a>
                                </div>
                                @enderror
                                <div class="row row pt-1  mt-6">
                                    <div class="col-xs-6 col-md-3 ">
                                        <label for="exampleInputPassword" class="form-label text-info font-italic" style=" padding-top:3%; margin-left: 44%">Confirm New Password</label>
                                    </div>
                                    <div class="col-xs-6 col-md-6 ">
                                        <input name="confirm_new_password" type="password" class="form-control" id="exampleInputPassword2">
                                    </div>
                                    <div class="col-xs-6 col-md-3 ">
                                        <button type="submit" class=" text-info font-italic" style="text-decoration: none; padding-top:3%;">Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@if (auth('web')->user()->type === 'regular')
@if (!empty(auth('web')->user()->articles ))
<p class=" display-4  text-center"> My Articles</p>
@endif
@if (session()->has('deleted'))
<div class="alert alert-warning" role="alert"> {{ session()->get('deleted') }} </div>
@endif
@foreach ($articles as $article)
@if ($article->user_id !== auth('web')->id() )
@continue;
@else
<section style="background-color: rgb(243, 245, 230);">
    <div class="container my-6 py-6">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-8 col-xl-11">
                <div class="card" style="background-color: rgb(243, 245, 235);">
                    <div class="card-body">
                        @include('repeatitions.article')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endforeach
@endif
@endsection
