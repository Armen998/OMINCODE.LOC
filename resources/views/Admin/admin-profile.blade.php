@extends('Admin.layout')

@section('content')
<section style="background-color: rgb(243, 245, 230);">
    <ul class="nav nav-tabs nav-fill mb-3 position " id="ex1" role="tablist">
        <!--  position-fixed d-flex  -->
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="ex2-tab-1" data-mdb-toggle="tab" href="{{ route('admin.home') }}" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">
                <i class=" fa-solid fa-house-chimney" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link "  id="ex2-tab-3" data-mdb-toggle="tab" href="{{ route('admin.articles') }} " role="tab" aria-controls="ex2-tabs-3" aria-selected="false">
                <i class="fa-regular fa-newspaper" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="ex2-tab-2" data-mdb-toggle="tab" href="{{ route('admin.users') }} " role="tab" aria-controls="ex2-tabs-2" aria-selected="false">
                <i class="fa fa-users" aria-hidden="true" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
    </ul>
</section>
<div class="container">
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
                        <form method="POST" action="{{ route('admin.data-update') }}">
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
                                    <input name="name" type="text" class="form-control  " id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth('admin')->user()->name }}">
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
                                    <input name="age" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{auth('admin')->user()->age }}">
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
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ auth('admin')->user()->email }}">
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
                            <form method="POST" action="{{ route('admin.password-update') }}">
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
@endsection