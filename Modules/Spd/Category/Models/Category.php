<?php

namespace Spd\Category\Models;

use Spd\User\Models\User;
use Spd\Article\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'parent_id', 'title', 'slug', 'keywords', 'description', 'status'];

    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    public static array $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    // Realtions
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }


    public function getParent()
    {
        if (is_null($this->parent_id)) return 'ندارد';

        return $this->parentCategory->title;
    }
}