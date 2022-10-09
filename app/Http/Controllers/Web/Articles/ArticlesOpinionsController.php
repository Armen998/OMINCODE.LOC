<?php

namespace App\Http\Controllers\Web\Articles;

use App\Http\Controllers\Controller;
use App\Services\Web\Articles\ArticlesService;

class ArticlesOpinionsController extends Controller
{
    protected $service;


    public function __construct(ArticlesService $service)
    {
        $this->service = $service;
    }


    public function articlesLike($id)
    {

        if ($this->service->like($id)) {

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function articlesDislike( $id)
    {
        if ($this->service->dislike($id)) {

            return redirect()->back();
        }
 
        return redirect()->back();
    }
}
