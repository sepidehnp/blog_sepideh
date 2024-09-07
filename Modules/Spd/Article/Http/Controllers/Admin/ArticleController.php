<?php
namespace Spd\Article\Http\Controllers\Admin;

use Spd\Article\Models\Article;
use App\Http\Controllers\Controller;
use Spd\Share\Services\ShareService;
use Spd\Share\Repositories\ShareRepo;
use Spd\Article\Services\ArticleService;
use Spd\Article\Repositories\ArticleRepo;
use Spd\Category\Repositories\CategoryRepo;
use Spd\Article\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{

    private string $class = Article::class;

    public ArticleRepo $repo;
    public ArticleService $service;

    public function __construct(ArticleRepo $articleRepo, ArticleService $articleService)
    {
        $this->repo = $articleRepo;
        $this->service = $articleService;
    }

    public function index()
    {
        //
        $this->authorize('manage', $this->class);
        $articles = $this->repo->index()->paginate(10);

        return view('Article::Admin.index', compact('articles'));
    }


    public function create(CategoryRepo $categoryRepo)
    {
        //
        $this->authorize('manage', $this->class);
        $categories = $categoryRepo->getActiveCategories()->get();

        return view('Article::Admin.create', compact('categories'));
    }


    public function store(ArticleRequest $request)
    {
        //
        $this->authorize('manage', $this->class);


        [$imageName, $imagePath] = ShareService::uploadImage($request->file('image'), 'articles');


        $this->service->store($request, auth()->id(), $imageName, $imagePath);

      //  alert()->success('ساخت مقاله', 'عملیات با موفقیت انجام شد');
      ShareRepo::successMessage('ساخت مقاله');
        return to_route('articles.index');
    }


    public function edit($id, CategoryRepo $categoryRepo)
    {
        //
        $this->authorize('manage', $this->class);
        $article = $this->repo->findById($id);
        $categories = $categoryRepo->getActiveCategories()->get();

        return view('Article::Admin.edit', compact(['article', 'categories']));
    }


    public function update(ArticleRequest $request, $id)
    {
        //
        $this->authorize('manage', $this->class);

        $file = $request->file('image');
        $article = $this->repo->findById($id);

        [$imageName, $imagePath] = $this->uploadImage($file, $article);

        $this->service->update($request, $id, $imageName, $imagePath);

      //  alert()->success('ویرایش مقاله', 'عملیات با موفقیت انجام شد');
      ShareRepo::successMessage('ویرایش مقاله');
        return to_route('articles.index');
    }


    public function destroy($id)
    {
        //
        $this->authorize('manage', $this->class);

        $article = $this->repo->findById($id);
        $this->service->deleteImage($article);
        $this->repo->delete($id);

       // alert()->success('حذف مقاله', 'عملیات با موفقیت انجام شد');
       ShareRepo::successMessage('حذف مقاله');
        return to_route('articles.index');
    }


    public function changeStatus($id)
    {
        $article = $this->repo->findById($id);
        $this->service->changeStatus($article);

      //  alert()->success('تغییر وضعیت مقاله', 'عملیات با موفقیت انجام شد');
      ShareRepo::successMessage('تغییر وضعیت مقاله');
        return to_route('articles.index');
    }

    // Private Method

    private function uploadImage($file, $article): array
    {
        //
        if (!is_null($file)) {
            [$imageName, $imagePath] = $this->service->uploadImage($file);
        }
        else {
            $imageName = $article->imageName;
            $imagePath = $article->imagePath;
        }

        return array($imageName, $imagePath);
    }
}
