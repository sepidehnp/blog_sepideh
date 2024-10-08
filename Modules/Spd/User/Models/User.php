<?php

namespace Spd\User\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spd\Article\Models\Article;
use Spd\Comment\Models\Comment;
use Laravel\Sanctum\HasApiTokens;
use Spd\Category\Models\Category;
use Overtrue\LaravelLike\Traits\Liker;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Liker;

    /**
     * The attributes that are mass assignable.
     *
     *
     */
    protected $fillable = [
        'name', 'email', 'password', 'telegram', 'linkedin', 'twitter', 'instagram', 'bio', 'imageName', 'imagePath', 'status'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

     // Variables
     public const STATUS_ACTIVE = 'active';
     public const STATUS_INACTIVE = 'inactive';

     public static array $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    // Methods
    public function textStatusEmailVerifiedAt(): string
    {
        if ($this->email_verified_at) return 'تایید شده';

        return 'تایید نشده';
    }

    public function cssStatusEmailVerifiedAt(): string
    {
        if($this->email_verified_at) return 'success';

        return 'danger';
    }

    public function path()
    {
        return route('users.author', $this->name);
    }

    public function image()
    {
        return asset('assets/imgs/authors/author-14.png');
    }

    // Relations
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
