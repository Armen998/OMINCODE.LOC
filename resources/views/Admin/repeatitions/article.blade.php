<tr>
    <td class=" text-center d-flax">
        <p style="margin-top: 25px !important;">{{ $article['title'] }}</p>
    </td>
    <td style="width: 25%">
        <div class="d-flex flex-start align-items-center">
            <div>
                @if ($article->user->avatar !== null)
                <img class="avatar" style="margin-right:0" src="{{ asset('/storage/' . $article->user->avatar ) }}">
                @else
                <img class="avatar" style="margin-right:0" src="{{ asset('/storage/icon/avatar.png') }}">
                @endif
            </div>
            <div class="justify-content-between">
                <div class="d-flex">
                    <p class=" text-info font-italic mb-2 h5"> Name: </p>
                    <span class="ml-2 font-italic h4" style="margin-top: 0px;"> {{ $article->user->name }} </span>
                </div>
                <div class="d-flex">
                    <p class=" text-info font-italic mb-2 h5"> Email: </p>
                    <span class="ml-2 font-italic h6" style="margin-top: 5px;"> {{ $article->user->email }} </span>
                </div>
            </div>
        </div>
    </td>
    <td class=" text-center d-flax">
        <p style="margin-top: 25px !important;"> {{ (strlen($article['description']) >= 20) ? substr($article['description'], 0, 20) . '...' : $article['description']}} </p>
    </td>
    <td class=" text-center d-flax">
        <p style="margin-top: 25px !important;"> {{ $article->created_at->diffForHumans() }} </p>
    </td>
    <td class=" text-center d-flax">
        <p style="margin-top: 25px !important;"> {{ $article->articleComments->count() }} </p>
    </td>
    <td class=" text-center d-flax">
        <p style="margin-top: 25px !important;"> {{ $article->likes_counts }} </p>
    </td>

    <td class=" text-center d-flax">
        <p style="margin-top: 25px !important;"> {{ $article->dislikes_counts }}</p>
    </td>
    <td>
        <div class=" small d-flex justify-content-start">
            <div>
                <button type="button" data-toggle="modal" data-target="#exampleModalCenter{{$article->id }}"><i style="font-size:36px; width:5rem; color:rgb(255, 115, 0)" class="fa-regular fa-trash-can"> </i></button>
               
            </div>
            @if ($article->block_time !== NULL)
            @php
            $block_time = strtotime("+7 day", strtotime($article->block_time) );
            $presentTyme = (int) date( time());
            @endphp
            @if($block_time >= $presentTyme)
            <div>
                <form method="POST" action="{{ route('admin.articles-unlock', ['id' => $article->id]) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit"><i style="font-size:36px; width:5rem;   color:rgb(255, 38, 0)  " class="fa fa-lock"> </i></button>
                </form>
            </div>
            @else
            <div>
                <form method="POST" action="{{ route('admin.articles-block', ['id' => $article->id]) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit"><i style="font-size:36px; width:5rem; color:rgb(0, 255, 0) " class="fa fa-unlock-alt"> </i></button>
                </form>
            </div>
            @endif
            @else
            <div>
                <form method="POST" action="{{ route('admin.articles-block', ['id' => $article->id]) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit"><i style="font-size:36px; width:5rem; color:rgb(0, 255, 0) " class="fa fa-unlock-alt"> </i></button>
                </form>
            </div>
            @endif
            @if ($article->articleFavorite->toArray() )

            <div>
                <form method="POST" action="{{ route('admin.articles-unfavorite', ['id' => $article->id]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit"><i style="font-size:36px; width:5rem; color:rgb(252, 244, 0) " class="fa fa-star "> </i></button>
                </form>
            </div>
            @else
            <div>
                <form method="POST" action="{{ route('admin.articles-favorite', ['id' => $article->id]) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit"><i style="font-size:36px; width:5rem; color:rgb(205, 204, 204) " class="fa fa-star "> </i></button>
                </form>
            </div>
            @endif
        </div>
    </td>
</tr>
