@extends('layout')

@section('content')

@auth()
<div class="container center mt-4">
    @if (auth('web')->user()->type === 'regular')
    <a class="" href="{{ route('articles-create') }}"><i style="font-size:70px; width:5rem; color:blue " class="fa-regular fa-calendar-plus"></i></a>
    @endif
    @if (session()->has('deleted'))
    <div class="alert alert-warning" role="alert"> {{ session()->get('deleted') }} </div>
    @endif
    @foreach ($articles as $article)
    @if ($article->block_time !== NULL)
    @php
    $block_time = strtotime("+7 day", strtotime($article->block_time) );
    $presentTyme = (int) date( time());
    @endphp
    @if($block_time >= $presentTyme)
    @continue;
    @endif
    @endif
    @if ($article->user_id !== auth('web')->id() && $article->status === 0 )
    @continue;
    @endif
    <section style="background-color: rgb(243, 245, 230);">
        <div class="container my-6 py-6">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-11">
                    <div class="card" style="background-color: rgb(243, 245, 235);">
                        <div class="card-body">
                            @include('repeatitions.article', ['article' => $article])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
</div>
@endauth
@endsection
