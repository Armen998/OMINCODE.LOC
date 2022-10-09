<?php

namespace App\Http\Controllers\Web\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCommentFormRequest;
use App\Services\Web\Articles\ArticlesCommentsService;


class ArticlesCommentsController extends Controller
{
    protected $service;

    public function __construct(ArticlesCommentsService $service)
    {
        $this->service = $service;
    }

    public function store(ArticleCommentFormRequest $request, $id)
    {
        $createdData = $request->validated();

        $created = $this->service->create($createdData, $id);

        if ($created) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function reply(ArticleCommentFormRequest $request, $id, $comment_id)
    {
        $createdData = $request->validated();

        $created = $this->service->reply( $comment_id, $createdData, $id);

        if ($created) {
            return redirect()->back();
        }
        return redirect()->back();
    }
}
