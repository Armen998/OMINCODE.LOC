<?php

namespace App\Services\Web\Articles;

use App\Models\Article;
use App\Models\ArticleComment;
use Illuminate\Support\Facades\DB;

class ArticlesCommentsService
{
    protected $articleCommentModel;

    protected $articleModel;

    public function __construct(Article $articleModel, ArticleComment $articleCommentModel,)
    {
        $this->articleCommentModel = $articleCommentModel;

        $this->articleModel = $articleModel;

    }

    //Add Comment
    public function create( $createdData, $id)
    {
        $article = $this->articleModel::where(['id' => $id])->first();

        DB::transaction(function () use ($article, $id, $createdData) {
             $commentData = [
                'user_id' => auth('web')->id(),
                'article_id' => $id,
                'parent_id' => NULL,
                'text' => $createdData['text'],  
            ];
            $created = $this->articleCommentModel::create($commentData);

            $updated = $this->articleModel::where(['id' => $id])->update(['comments_counts' => $article->comments_counts + 1, 'updated_at' => $article->updated_at]);
           if($created && $updated) {
            DB::commit();
            return true;
           }
        },3);
       return false;
    }

    public function reply( $comment_id, $createdData, $id)
    {
        $article = $this->articleModel::where(['id' => $id])->first();

        DB::transaction(function () use ($article, $comment_id, $createdData, $id) {
             $commentData = [
                'user_id' => auth('web')->id(),
                'article_id' => $id,
                'parent_id' => $comment_id,
                'text' => $createdData['text'],  
            ];
            $created = $this->articleCommentModel::create($commentData);

            $updated = $this->articleModel::where(['id' => $id])->update(['comments_counts' => $article->comments_counts + 1, 'updated_at' => $article->updated_at]);
           if($created && $updated) {
            DB::commit();
            return true;
           }
        },3);
       return false;
    }
}

