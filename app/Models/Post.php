<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'content','cover_image','user_id','category_id'];

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }
    /**
     * The tags that belong to the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
