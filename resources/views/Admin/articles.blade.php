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
            <a class="nav-link active" style="background-color: rgb(243, 245, 240);" id="ex2-tab-3" data-mdb-toggle="tab" href="{{ route('admin.articles') }} " role="tab" aria-controls="ex2-tabs-3" aria-selected="false">
                <i class="fa-regular fa-newspaper" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link " id="ex2-tab-2" data-mdb-toggle="tab" href="{{ route('admin.users') }} " role="tab" aria-controls="ex2-tabs-2" aria-selected="false">
                <i class="fa fa-users" aria-hidden="true" style="font-size:40px; color:rgb(73 80 87)"></i>
            </a>
        </li>
    </ul>
    @if (session()->has('article_deleted'))
    <div class="alert alert-warning" role="alert"> {{ session()->get('article_deleted') }} </div>
    @endif

    @if (session()->has('blocked'))
    <div class="alert alert-warning" role="alert"> {{ session()->get('blocked') }} </div>
    @endif

    @if (session()->has('unlocked'))
    <div class="alert alert-success" role="alert"> {{ session()->get('unlocked') }} </div>
    @endif

    @if (session()->has('favorited'))
    <div class="alert alert-success" role="alert"> {{ session()->get('favorited') }} </div>
    @endif

    @if (session()->has('unfavorited'))
    <div class="alert alert-warning" role="alert"> {{ session()->get('unfavorited') }} </div>
    @endif
    <div class="container my-10 py-10">
        <div class="row d-flex justify-content-center">
            <div class="card" style=";background-color: rgb(243, 245, 235);">
                <div class="card-body">
                    <div>
                        <table class="table">
                            <tr>
                                <th scope="col" class=" text-center">Title</th>
                                <th scope="col" class=" text-center">User</th>
                                <th scope="col" class=" text-center">Description</th>
                                <th scope="col" class=" text-center">Created At</th>
                                <th scope="col" style=" width: 50px">Comments Count</th>
                                <th scope="col" style="width: 50px">Likes Count</th>
                                <th scope="col" style="width: 50px">Dislikes Count</th>
                                <th scope="col" class=" text-center">Actions</th>
                            </tr>
                            <tbody>
                                @foreach($articles as $article)
                                @if($article->articleFavorite->toArray() !== [])
                                @include('Admin.repeatitions.article')
                                @endif
                                @continue;
                                @endforeach
                                @foreach($articles as $article)
                                @if($article->articleFavorite->toArray() === [])
                                @include('Admin.repeatitions.article')
                                @endif
                                @continue;
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
