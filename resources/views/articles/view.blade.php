@extends('layout')

@section('content')
@php $article = $articles[0]; @endphp
<div class="container">
    <section style="background-color: rgb(243, 245, 230);">
        <div class="container my-6 py-6">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-8 col-xl-11">
                    <div class="card" style="background-color: rgb(243, 245, 235);">
                        <div class="card-body">
                            @include('repeatitions.article')
                            @if ($article->user_id !== auth()->id())
                            <div class="my-2 py-2">
                                <form action="{{ route('articles-comments-store', ['id' => $article->id]) }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="submite" class="form-control" placeholder="Reply to comments" name="text" style=" width:5rem;">
                                        <button class="" type="submit"> <i style="font-size:36px; width:5rem; color:green " class="fa-solid  fa-comment"> </i> </button>
                                        <button class="" type="reset"> <i style="font-size:36px; width:5rem; color: orange" class="fa-solid  fa-comment-slash"> </i> </button>
                                    </div>
                                </form>
                            </div>
                            @endif
                            <p class=" display-4 font-italic  text-center"> Comments </p>
                            @foreach ($article->articleComments as $comment)
                            @dd($comment)
                            @php
                            $i = 0
                            @endphp
        
                            @if ($comment->parent_id === null)
                            @include( 'articles.comments.list', [ 'comment' => $comment, 'i' => $i ] )
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
