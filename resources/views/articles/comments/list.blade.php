<div style=" width:  100%; margin-top: 20px  ">
    <section style="background-color: rgb(243, 245, 230);">
        <div class="container ">
            <div class="row d-flex justify-content-center" style="width: 103.4%">
                <div class="col-md-12 col-lg-8 col-xl-11" style="padding-right: 0px !important">
                    <div class="card" style="background-color: rgb(243, 245, 235);">
                        <div class="card-body">
                            <div>
                                <div class="d-flex flex-start align-items-center">
                                    @if ($comment->user->avatar !== null)
                                    <img class="avatar" src="{{ asset('/storage/' . $comment->user->avatar ) }}">
                                    @else
                                    <img class="avatar" src="{{ asset('/storage/icon/avatar.png') }}">
                                    @endif
                                    <div>
                                        <p class=" text-info font-italic mb-2 h4"> {{ $comment->user->name }} </p>
                                        <p class="text-muted small mb-0">
                                            Shared publicly - {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <p class=" text-muted mt-3 col-mb-4 col-md-6  pb-2 h4">
                                        {{ $comment->text }}
                                    </p>
                                </div>
                                <div>
                                    <div class="my-2 ">
                                        <form action="{{ route('articles-comments-reply', ['id' => $article->id, 'comment_id' => $comment->id]) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <input type="submite" class="form-control" placeholder="Reply to comments" name="text" style=" width:5rem;">
                                                <button class="" type="submit"> <i style="font-size:36px; width:5rem; color:green " class="fa-solid  fa-comment"> </i> </button>
                                                <button class="" type="reset"> <i style="font-size:36px; width:5rem; color: orange" class="fa-solid  fa-comment-slash"> </i> </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $i ++
                @endphp
                @if(!empty($comment->comments->toArray()))
                @foreach ( $comment->comments as $comment )
                @include( 'articles.comments.list', [ 'comment' => $comment, 'i' => $i ])
                @endforeach
                @endif
            </div>
        </div>
    </section>
</div>
