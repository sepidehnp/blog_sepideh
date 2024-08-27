<?php

namespace Spd\Article\Http\Controllers\Home;

use Spd\Article\Models\Article;
use Spd\Home\Repositories\HomeRepo;
use App\Http\Controllers\Controller;
use Spd\Share\Repositories\ShareRepo;
use Spd\Article\Services\ArticleService;
use Spd\Article\Repositories\ArticleRepo;
use Spd\Comment\Repositories\CommentRepo;
use Spd\Category\Repositories\CategoryRepo;
use Spd\Article\Http\Requests\ArticleRequest;

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
 
    public function home(CommentRepo $commentRepo)
    {
        $articles = $this->repo->home()->paginate(6);
        $viewsArticles = $this->repo->getArticlesByViews()->latest()->limit(5)->get();
        $latestComments = $commentRepo->getLatestComments()->limit(3)->get();

        return view('Article::Home.home', compact(['articles', 'viewsArticles', 'latestComments']));
    }


      public function details($slug, HomeRepo $homeRepo)
    {
        $article = $this->repo->findBySlug($slug);

        if (is_null($article)) abort(404);
        $relatedArticles = $this->repo->relatedArticles($article->category_id, $article->id)->limit(3)->get();

        return view('Article::Home.details', compact(['article', 'relatedArticles', 'homeRepo']));
    }
}
