<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Controller;
use App\Services\Admin\Articles\ArticlesService;




class ArticlesController extends Controller
{
    protected $service;

    public function __construct(ArticlesService $service)
    {
        $this->service = $service;
    }

    //Article
    public function index()
    {
        $data = $this->service->index();

        return view('admin.articles', ['articles' => $data['articles'], 'regularUsers' => $data['regularUsers'], 'adminUsers' => $data['adminUsers']]);
    }

    // Article block
    public function articleBlock($id)
    {
        $articleBlock = $this->service->articleBlock($id);

        if ($articleBlock) {
            $tmp = $articleBlock->user->name . '\'s ' . ' ' . ' \'\'' . $articleBlock->title . '\'\'' . ' article for a week blocked.';
            return redirect('admin/articles')->with(['blocked' => $tmp]);
        }
        return redirect()->back();
    }

    // Article unlock
    public function articleUnlock($id)
    {
        $articleBlock = $this->service->articleUnlock($id);

        if ($articleBlock) {
            $tmp = $articleBlock->user->name . '\'s ' . ' ' . ' \'\'' . $articleBlock->title . '\'\'' . ' article unlocked.';
            return redirect('admin/articles')->with(['unlocked' => $tmp]);
        }
        return redirect()->back();
    }



    
    // Article favorite
    public function articleFavorite($id)
    {
        $articleFavorite = $this->service->articleFavorite($id);

        if ($articleFavorite) {
            $tmp = $articleFavorite->user->name . '\'s ' . ' ' . ' \'\'' . $articleFavorite->title . '\'\'' . ' article favorited.';
            return redirect('admin/articles')->with(['favorited' => $tmp]);
        }
        return redirect()->back();
    }

    public function articleUnfavorite($id)
    {
        $articlesUnfavorite = $this->service->articlesUnfavorite($id);

        if ($articlesUnfavorite) {
            $tmp = $articlesUnfavorite->user->name . '\'s ' . ' ' . ' \'\'' . $articlesUnfavorite->title . '\'\'' . ' article unfavorited.';
            return redirect('admin/articles')->with(['unfavorited' => $tmp]);
        }
        return redirect()->back();
    }

    //Article Delete
    public function articleDestroy($id)
    {
        $delete = $this->service->articleDestroy($id);

        if ($delete) {
            $tmp = $delete->user->name . '\'s ' . ' ' . ' \'\'' . $delete->title . '\'\'' . ' article has been deleted.';
            return redirect('admin/articles')->with(['article_deleted' => $tmp]);
        }
        return redirect()->back();
    }
}
