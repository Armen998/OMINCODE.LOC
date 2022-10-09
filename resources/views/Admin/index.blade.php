@extends('Admin.layout')

@section('content')
<section style="background-color: rgb(243, 245, 230);">
    <ul class="nav nav-tabs nav-fill mb-3 position " id="ex1" role="tablist">
        <!--  position-fixed d-flex  -->
        <li class="nav-item" role="presentation">
            <a class="nav-link active" style="background-color: rgb(243, 245, 240);" id="ex2-tab-1" data-mdb-toggle="tab" href="#ex2-tabs-1" role="tab" aria-controls="ex2-tabs-1" aria-selected="true">
                <i class=" fa-solid fa-house-chimney" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex2-tab-3" data-mdb-toggle="tab" href="{{ route('admin.articles') }} " role="tab" aria-controls="ex2-tabs-3" aria-selected="false">
                <i class="fa-regular fa-newspaper" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ex2-tab-2" data-mdb-toggle="tab" href="{{ route('admin.users') }} " role="tab" aria-controls="ex2-tabs-2" aria-selected="false">
                <i class="fa fa-users" aria-hidden="true" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
    </ul>
    <div class="container my-10 py-10">
        <div class="row d-flex justify-content-center">
            <div class="card" style="background-color: rgb(243, 245, 235);">
                <div class="card-body">
                    <div>
                        <div class="d-flex">
                            <p class=" text-info font-italic h3" style="width:250px, font-weight: 900;letter-spacing: 2px;"> Total Users: </p> <span class="ml-2 font-italic h4" style="margin-top: 5px;"> {{ $regularUsers->count() }} </span>
                        </div>
                        <div class="d-flex">
                            <p class=" text-info font-italic h3" style="width:250px, font-weight: 900;letter-spacing: 2px;"> Total Articles: </p> <span class="ml-2 font-italic h4" style="margin-top: 5px;"> {{ $articles->count() }} </span>
                        </div>
                        @if ($articles->count() === 0 || $regularUsers->count() === 0)
                        <div class="d-flex">
                            <p class=" text-info font-italic h3" style="width:250px, font-weight: 900;letter-spacing: 2px;"> Avarage article per user: </p> <span class="ml-2 font-italic h4" style="margin-top: 5px;"> 0 </span>
                        </div>
                        @else
                        <div class="d-flex">
                            <p class=" text-info font-italic h3" style="width:250px, font-weight: 900;letter-spacing: 2px;"> Avarage article per user: </p> <span class="ml-2 font-italic h4" style="margin-top: 5px;"> {{ $articles->count()/$regularUsers->count() }} </span>
                        </div 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection





  