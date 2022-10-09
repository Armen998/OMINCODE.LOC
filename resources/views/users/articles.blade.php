@extends('layout')

@section('content')
<div class="container">
    <table class="table">
        <tr>
            <a class="" href="{{ route('articles-create') }}"><i style="font-size:70px; width:5rem; color:blue " class="fa-regular fa-calendar-plus"></i></a>
        </tr>   
        <p class=" display-4  text-center"> My Articles</p>
        @if (session()->has('deleted'))
        <div class="alert alert-warning" role="alert"> {{ session()->get('deleted') }} </div>
        @endif
        @foreach ($articles as $article)
        @if ($article->user_id !== auth()->id() && $article->status === 0)
        @continue;
        @endif 
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
        @endforeach
    </table>
</div>
@endsection
