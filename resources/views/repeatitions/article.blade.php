<div>
    <div class="d-flex flex-start align-items-center">
        @if ($article->user->avatar !== null)
        <img class="avatar" src="{{ asset('/storage/' . $article->user->avatar ) }}">
        @else
        <img class="avatar" src="{{ asset('/storage/icon/avatar.png') }}">
        @endif
        <div class="justify-content-between">
            <p class=" text-info font-italic mb-2 h4"> {{ $article->user->name }} </p>
            <p class="text-muted small mb-0">
                Shared publicly - {{ $article->created_at->diffForHumans() }}
            </p>
        </div>
        @if ($article->user_id === auth('web')->id())
        <div class="d-flex  ">
            <div class="">
                <a href="{{ route('articles-edit', $article->id) }}"> <i style="font-size:36px; width:5rem; color:rgb(0, 238, 255);" class="fa-regular fa-pen-to-square"></i> </a>
            </div>
            <div>
                <button type="button" data-toggle="modal" data-target="#exampleModalCenter{{ $article->id }}"><i style="font-size:36px; width:5rem; color: red " class="fa-regular fa-trash-can"> </i></button>
            </div>
        </div>
        @endif
    </div>
    <p class=" text-muted mt-3 col-mb-4 col-md-6  pb-2 h4">
        {{ $article->title }}
    </p>
    <p class=" text-muted mt-3 col-mb-4 col-md-6 pb-2 h5 ">
        {{ $article->description }}
    </p>
    <div class="small d-flex justify-content-start">
        @if($article->user_id === auth('web')->id() || auth('web')->user()->type === 'admin')
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->likes_counts }} </p>
            <p class="text-muted small mb-0">
                <i style="font-size:36px; color:blue" class="fa-regular text-center fa-thumbs-up"></i>
            </p>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->dislikes_counts }} </p>
            <p class="text-muted small mb-0">
                <i style="font-size:36px; color:black ; width: 5rem" class="fa-regular text-center fa-thumbs-down"> </i>
            </p>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->comments_counts }} </p>
            <p class="text-muted small mb-0">
                <a class="" href="{{ route('articles-view', $article->id) }}">
                    <i style="font-size:36px;" class="far text-info text-center fa-comment-dots me-2"></i>
                </a>
            </p>
        </div>
        @else  
        @if ($article->articleOpinion->toArray() === [])
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->likes_counts }} </p>
            <p class="text-muted small mb-0">
                <form action="{{ route('articles-like', ['id' => $article->id]) }}" method="POST">
                    @csrf
                    <button type="onclick" class="success " id="success-outlined{{ $article->id . '1' }}">
                        <i style="font-size:36px; color:blue" class="fa-regular fa-thumbs-up"></i>
                    </button>
                </form>
            </p>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->dislikes_counts }} </p>
            <p class="text-muted small mb-0">
                <form action="{{ route('articles-dislike', ['id' => $article->id]) }}" method="POST">
                    @csrf
                    <button type="onclick" class="" id="danger-outlined{{ $article->id }}">
                        <i style="font-size:36px; color:black ; width: 5rem" class="fa-regular fa-thumbs-down"> </i>
                    </button>
                </form>
            </p>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->comments_counts }} </p>
            <p class="text-muted small mb-0">
                <a class="" href="{{ route('articles-view', $article->id) }}">
                    <i style="font-size:36px;" class="far text-info text-center fa-comment-dots me-2"></i>
                </a>
            </p>
        </div>
        @else    
        @if ($article->articleOpinion[0]->is_like === 1)
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->likes_counts }} </p>
            <form action="{{ route('articles-like', ['id' => $article->id]) }}" method="POST">
                @csrf
                <button type="onclick" class="success" id="success-outlined{{ $article->id . '1' }}">
                    <i style="font-size:36px; color:blue " class="fa-solid  fa-thumbs-up"> </i>
                </button>
            </form>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->dislikes_counts }} </p>
            <form action="{{ route('articles-dislike', ['id' => $article['id']]) }}" method="POST">
                @csrf
                <button type="onclick" class="" id="danger-outlined{{ $article->id }}">
                    <i style="font-size:36px; color:black ; width:5rem" class="fa-regular fa-thumbs-down"> </i>
                </button>
            </form>
            </p>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->comments_counts }} </p>
            <p class="text-muted small mb-0">
                <a class="" href="{{ route('articles-view', $article->id) }}">
                    <i style="font-size:36px;" class="far text-info text-center fa-comment-dots me-2"></i>
                </a>
            </p>
        </div>
        @elseif ($article->articleOpinion[0]->is_dislike === 1)
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->likes_counts }} </p>
            <form action="{{ route('articles-like', ['id' => $article->id]) }}" method="POST" class="">
                @csrf
                <button type="onclick" class="success" id="success-outlined{{ $article->id . '1' }}">
                    <i style="font-size:36px; color:blue" class="fa-regular fa-thumbs-up"> </i>
                </button>
            </form>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->dislikes_counts }} </p>
            <form action="{{ route('articles-dislike', ['id' => $article->id]) }}" method="POST">
                @csrf
                <button type="onclick" class="" id="danger-outlined{{ $article->id }}">
                    <i style="font-size:36px; color:black ; width:5rem" class="fas fa-thumbs-down"> </i>
                </button>
            </form>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->comments_counts }} </p>
            <p class="text-muted small mb-0">
                <a class="" href="{{ route('articles-view', $article->id) }}">
                    <i style="font-size:36px;" class="far text-info text-center fa-comment-dots me-2"></i>
                </a>
            </p>
        </div>
        @else
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->likes_counts }} </p>
            <form action="{{ route('articles-like', ['id' => $article->id]) }}" method="POST">
                @csrf
                <button type="onclick" class=" success" id="success-outlined{{ $article->id . '1' }}">
                    <i style="font-size:36px; color:blue" class="fa-regular fa-thumbs-up"> </i>
                </button>
            </form>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->dislikes_counts }} </p>
            <form action="{{ route('articles-dislike', ['id' => $article->id]) }}" method="POST">
                @csrf
                <button type="onclick" class=" " id="danger-outlined{{ $article->id }}">
                    <i style="font-size:36px; color:black; width:5rem" class="fa-regular fa-thumbs-down"> </i>
                </button>
            </form>
        </div>
        <div>
            <p class=" text-info font-italic text-center mb-2 h4"> {{ $article->comments_counts }} </p>
            <p class="text-muted small mb-0">
                <a class="" href="{{ route('articles-view', $article->id) }}">
                    <i style="font-size:36px;" class="far text-info text-center fa-comment-dots me-2"></i>
                </a>
            </p>
        </div>
        @endif
        @endif
        @endif
    </div>
</div>
