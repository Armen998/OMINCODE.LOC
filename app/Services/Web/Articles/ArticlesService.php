<?php

namespace App\Services\Web\Articles;

use App\Models\Article;
use App\Models\ArticleOpinion;
use App\Models\ArticleComment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ArticlesService
{
    protected $userModel; 

    protected $articleModel;

    protected $articleOpinionModel;

    protected $articleOpinionCountModel;

    public function __construct(Article $articleModel, User $userModel, ArticleComment $articleCommentModel, ArticleOpinion $articleOpinionModel)
    {
        $this->articleOpinionModel = $articleOpinionModel;

        $this->articleCommentModel = $articleCommentModel;

        $this->articleModel = $articleModel;

        $this->userModel = $userModel;
    }

    public function view($id)
    {
        $articles = $this->articleModel::with([
            'user',
            'articleComments.user',
            'articleComments' => function ($query) use ($id) {
                $query->where(['article_id' => $id]);
            },
            'articleOpinion' => function ($query) {
                $query->where(['user_id' => auth('web')->id()]);
            }
        ])->where(['id' => $id])->get();
        return ['articles' => $articles];
    }

    public function addArticle()
    {
        $users = auth('web')->id();

        $user = $this->userModel::with(['articles' => function ($query) {
            $query->where(['user_id' => auth('web')->id()]);
        }])->where(['id' => auth('web')->id()])->get(['id', 'name', 'age', 'email',]);

        return [
            'users' => $users,
            'user' => $user
        ];
    }

    public function create($createdData)
    {
        $articleData = [
            'user_id' => auth('web')->id(),
            'title' => $createdData['title'],
            'description' => $createdData['description'],
            'status' => $createdData['status']
        ];

        if ($this->articleModel::create($articleData)) {
            return true;
        }
        return false;
    }

    public function updatedArticle($id)
    {
        $articles = $this->articleModel::where(['id' => $id])->first(['id', 'user_id', 'title', 'description', 'status']);

        if ($articles->user_id === auth('web')->id()) {
            return $articles;
        }
        return false;
    }

    public function update($id, $updatedData)
    {
        $articleData = $this->articleModel::where(['id' => $id], ['user_id'] === auth('web')->id())->first(['title', 'description', 'status']);

        $checkTitle = $this->articleModel::where(['title' => $updatedData['title']])->first(['title']);

        if (!empty([$articleData, $updatedData]) && empty($checkTitle) || $checkTitle->title === $articleData->title) {
            $this->articleModel::find($id)->update($updatedData);
            return true;
        }
        return false;
    }

    public function like($id)
    {
        $article = $this->articleModel::where(['id' => $id])->first();

        $checkLikeDislike =  $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->first();

        if (empty($checkLikeDislike)) {
            DB::transaction(function () use ($article, $id) {
                $opinionData = [
                    'user_id' => auth('web')->id(),
                    'article_id' => $id,
                    'is_like' => 1,
                    'is_dislike' => 0,
                ];
                $created = $this->articleOpinionModel::create($opinionData);

                $updated =  $this->articleModel::where(['id' => $id])->update(['likes_counts' => $article->likes_counts + 1, 'updated_at' => $article->updated_at]);
                if ($created && $updated) {
                    DB::commit();
                }
            }, 3);
        } else {
            if ($checkLikeDislike->is_like === 0 && $checkLikeDislike->is_dislike === 1) {
                DB::transaction(function () use ($article, $id) {
                $updatedCounts = $this->articleModel::where(['id' => $id])->update(['likes_counts' => $article->likes_counts + 1, 'dislikes_counts' => $article->dislikes_counts - 1, 'updated_at' => $article->updated_at]);
                $updatedOpinion = $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->update(['is_like' => 1, 'is_dislike' => 0]);
                if ($updatedCounts && $updatedOpinion) {
                    DB::commit();
                }
            }, 3);
            } elseif ($checkLikeDislike->is_like === 1 && $checkLikeDislike->is_dislike === 0) {
                DB::transaction(function () use ($article, $id) {
                    $updatedCounts = $this->articleModel::where(['id' => $id])->update(['likes_counts' => $article->likes_counts - 1, 'updated_at' => $article->updated_at]);
                    $updatedOpinion =  $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->update(['is_like' => 0, 'is_dislike' => 0]);
                    if ($updatedCounts && $updatedOpinion) {
                        DB::commit();
                    }
                }, 3);
            } elseif ($checkLikeDislike->is_like === 0 && $checkLikeDislike->is_dislike === 0) {
                DB::transaction(function () use ($article, $id) {
                    $updatedCounts = $this->articleModel::where(['id' => $id])->update(['likes_counts' => $article->likes_counts + 1, 'updated_at' => $article->updated_at]);
                    $updatedOpinion = $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->update(['is_like' => 1, 'is_dislike' => 0]);
                    if ($updatedCounts && $updatedOpinion) {
                        DB::commit();
                    }
                }, 3);
            }
            return true;
        }
        return false;
    }

    public function dislike($id)
    {
        $article = $this->articleModel::where(['id' => $id])->first();

        $checkLikeDislike =  $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->first();

        if (empty($checkLikeDislike)) {
            DB::transaction(function () use ($article, $id) {
                $opinionData = [
                    'user_id' => auth('web')->id(),
                    'article_id' => $id,
                    'is_like' => 0,
                    'is_dislike' => 1,
                ];
                $created = $this->articleOpinionModel::create($opinionData);

                $updated =  $this->articleModel::where(['id' => $id])->update(['dislikes_counts' =>  $article->dislikes_counts + 1, 'updated_at' => $article->updated_at]);
                if ($created && $updated) {
                    DB::commit();
                }
            }, 3);
        } else {
            if ($checkLikeDislike->is_like === 1 && $checkLikeDislike->is_dislike === 0) {
                DB::transaction(function () use ($article, $id) {
                    $updatedCounts =  $this->articleModel::where(['id' => $id])->update(['likes_counts' =>  $article->likes_counts - 1, 'dislikes_counts' =>  $article->dislikes_counts + 1, 'updated_at' => $article->updated_at]);
                    $updatedOpinion = $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->update(['is_like' => 0, 'is_dislike' => 1]);
                    if ($updatedCounts && $updatedOpinion) {
                        DB::commit();
                    }
                }, 3);
            } elseif ($checkLikeDislike->is_like === 0 && $checkLikeDislike->is_dislike === 1) {
                DB::transaction(function () use ($article, $id) {
                    $updatedCounts = $this->articleModel::where(['id' => $id])->update(['dislikes_counts' =>  $article->dislikes_counts - 1, 'updated_at' => $article->updated_at]);
                    $updatedOpinion = $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->update(['is_like' => 0, 'is_dislike' => 0]);
                    if ($updatedCounts && $updatedOpinion) {
                        DB::commit();
                    }
                }, 3);
            } elseif ($checkLikeDislike->is_like === 0 && $checkLikeDislike->is_dislike === 0) {
                DB::transaction(function () use ($article, $id) {
                    $updatedCounts = $this->articleModel::where(['id' => $id])->update(['dislikes_counts' =>  $article->dislikes_counts + 1, 'updated_at' => $article->updated_at]);
                    $updatedOpinion = $this->articleOpinionModel::where(['user_id' => auth('web')->id(), 'article_id' => $id])->update(['is_like' => 0, 'is_dislike' => 1]);
                    if ($updatedCounts && $updatedOpinion) {
                        DB::commit();
                    }
                }, 3);
            }
            return true;
        }
        return false;
    }

    public function destroy($id)
    {
        $deleteInArticle = $this->articleModel::find($id)->delete();

        if ($deleteInArticle) {
            return true;
        } else {
            return false;
        }
    }
}
