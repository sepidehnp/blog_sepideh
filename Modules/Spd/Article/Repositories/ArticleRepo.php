<?php

namespace Spd\Article\Repositories;

use Spd\Article\Models\Article;

class ArticleRepo
{
    public function index()
    {
        return $this->query()->latest();
    }

    public function findById($id)
    {
        return $this->query()->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->query()->where('id', $id)->delete();
    }

    public function findBySlug($slug)
    {
        return $this->query()->whereSlug($slug)->first();
    }
 // Home Query
    public function relatedArticles($categoryId, $id)
    {
        return $this->query()
            ->where('category_id', $categoryId)
            ->whereStatus(Article::STATUS_ACTIVE)
            ->where('id', '!=', $id);
    }


    private function query()
    {
        return Article::query();
    }
}
