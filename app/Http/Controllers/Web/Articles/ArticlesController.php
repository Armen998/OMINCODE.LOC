<?php

namespace App\Http\Controllers\Web\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleFormRequest;
use App\Http\Requests\ArticleUpdatedFormRequest;
use App\Services\Web\Articles\ArticlesService;

class ArticlesController extends Controller
{
    protected $service;

    public function __construct(ArticlesService $service, )
    {
        $this->service = $service;
    }

    // Article View
    public function view($id)
    {
        $data = $this->service->view($id);

        return view('articles.view', ['articles' => $data['articles']]);
    }

    //Add Article
    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleFormRequest $request)
    {
        $createdData = $request->validated();

        $created = $this->service->create($createdData);

        if ($created) {
            return redirect()->route('home');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $data = $this->service->updatedArticle($id);

        if ($data) {
            return view('articles.edit',  ['articles' => $data]);
        }
        return redirect()->back();
    }


    //Updated Article
    public function update(ArticleUpdatedFormRequest $request, $id)
    {
        $updatedData = $request->validated();

        $updated = $this->service->update($id, $updatedData);

        if ($updated) {
            return redirect()->back()->with(['changed' => 'your article information has been changed.']);
        }
        return redirect()->back()->with(['indication' => 'Your data has not changed.']);
    }

    //Delete Article
    public function destroy($id)
    {
        $delete = $this->service->destroy($id);

        if ($delete) {
            return redirect('home')->with(['deleted' => 'your article  has been deleted.']);;
        }
        return redirect()->back();
    }
}
