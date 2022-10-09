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
            <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="{{ route('admin.articles') }} " role="tab" aria-controls="ex2-tabs-3" aria-selected="false">
                <i class="fa-regular fa-newspaper" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" style="background-color: rgb(243, 245, 240);" id="ex2-tab-2" data-mdb-toggle="tab" href="{{ route('admin.users') }} " role="tab" aria-controls="ex2-tabs-2" aria-selected="false">
                <i class="fa fa-users" aria-hidden="true" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
    </ul>
    @if (session()->has('user_deleted'))
    <div class="alert alert-warning" role="alert"> {{ session()->get('user_deleted') }} </div>
    @endif
    @if (session()->has('make_admin'))
    <div class="alert alert-success" role="alert"> {{ session()->get('make_admin') }} </div>
    @endif
    @if (session()->has('make_regular'))
    <div class="alert alert-warning" role="alert"> {{ session()->get('make_regular') }} </div>
    @endif
    <div class="container" style="height: 10px;">
        <a class=" text-center my-10 py-10" href="{{ route('admin.user-add') }}"><i style="font-size:70px;height: 40px; width:5rem;color:rgb(126, 126, 255)" class=" fa-solid fa-user-plus"></i> </a>
    </div>
</section>
<div class="container my-10 py-10">
    <div class="row d-flex justify-content-center">
        <div class="card" style=";background-color: rgb(243, 245, 235);">
            <div class="card-body">
                <div>
                    <table class="table">
                        <tr>
                            <th scope="col" class=" text-center">User</th>
                            <th scope="col" class=" text-center">Name</th>
                            <th scope="col" class=" text-center">Type</th>
                            <th scope="col" class=" text-center">Age</th>
                            <th scope="col" class=" text-center">Email</th>
                            <th scope="col" class=" text-center">Registred At</th>
                            <th scope="col" class=" text-center">Actions</th>
                        </tr>
                        <tbody>
                            @foreach ($adminUsers as $adminUser)
                            @if($adminUser->id === auth('admin')->id())
                            @continue
                            @endif
                            <tr>
                                <td class=" text-center d-flax" style="width: 100px !important;">
                                    <div class=" text-center d-flax">
                                        @if ($adminUser->avatar !== null)
                                        <img class="avatar" style=" margin-right: 0px; margin-left: 0px;" src="{{ asset('/storage/' .$adminUser->avatar ) }}">
                                        @else
                                        <img class="avatar" style=" margin-right: 0px; margin-left: 0px;" src="{{ asset('/storage/icon/avatar.png') }}">
                                        @endif
                                    </div>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $adminUser->name }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $adminUser->type }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $adminUser->age }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $adminUser->email }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $adminUser->created_at->diffForHumans() }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <div class=" small d-flex justify-content-start">
                                        <div>
                                            <form method="POST" action="{{ route('admin.urers-destroy', ['id' => $adminUser->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"><i style="font-size:36px; width:5rem; color:rgb(255, 115, 0)" class=" fa-regular fa-trash-can"> </i></button>
                                            </form>
                                        </div>
                                        <div>
                                            <form method="POST" action="{{ route('admin.make-regular', ['id' => $adminUser->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"><img style=" height: 40px; margin-right: 0px; margin-left: 0px;" src="{{ asset('/storage/icon/regular.png') }}"></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @foreach ($regularUsers as $regularUser)
                            @if($regularUser->id === auth('admin')->id())
                            @continue
                            @endif
                            <tr>
                                <td class=" text-center d-flax" style="width: 100px !important;">
                                    <div class=" text-center d-flax">
                                        @if ($regularUser->avatar !== null)
                                        <img class="avatar" style=" margin-right: 0px; margin-left: 0px;" src="{{ asset('/storage/' . $regularUser->avatar ) }}">
                                        @else
                                        <img class="avatar" style=" margin-right: 0px; margin-left: 0px;" src="{{ asset('/storage/icon/avatar.png') }}">
                                        @endif
                                    </div>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $regularUser->name }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $regularUser->type }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $regularUser->age }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $regularUser->email }} </p>
                                </td>
                                <td class=" text-center d-flax">
                                    <p style="margin-top: 25px !important;"> {{ $regularUser->created_at->diffForHumans() }} </p>
                                </td>
                                <td>
                                    <div class=" small d-flex justify-content-start">
                                        <div>
                                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter{{ $regularUser->id  }}"><i style="font-size:36px; width:5rem; color:rgb(255, 115, 0)" class="fa-regular fa-trash-can"> </i></button>
                                        </div>
                                        <div>
                                            <form method="POST" action="{{ route('admin.make-admin', ['id' => $regularUser->id]) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"><img style=" height: 40px; margin-right: 1%; margin-left: 0px;" src="{{ asset('/storage/icon/adminn.png') }}"></button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
