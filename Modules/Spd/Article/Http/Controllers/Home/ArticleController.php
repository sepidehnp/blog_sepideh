<?php

namespace Spd\Article\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Spd\Article\Http\Requests\ArticleRequest;
use Spd\Article\Models\Article;
use Spd\Article\Repositories\ArticleRepo;
use Spd\Article\Services\ArticleService;
use Spd\Category\Repositories\CategoryRepo;
use Spd\Share\Repositories\ShareRepo;
use Spd\Home\Repositories\HomeRepo;

class ArticleController extends Controller
{
    public ArticleRepo $repo;

    public function __construct(ArticleRepo $articleRepo)
    {
        $this->repo = $articleRepo;
    }

//    public function index()
//    {
//        $articles = $this->repo->index()->paginate(10);
//
//        return view('Article::Admin.index', compact('articles'));
//    }

      public function details($slug, HomeRepo $homeRepo)
    {
        $article = $this->repo->findBySlug($slug);

        if (is_null($article)) abort(404);
        $relatedArticles = $this->repo->relatedArticles($article->category_id, $article->id)->limit(3)->get();

        return view('Article::Home.details', compact(['article', 'relatedArticles', 'homeRepo']));
    }
}
