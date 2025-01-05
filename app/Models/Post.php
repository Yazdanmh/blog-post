<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'posts_articles');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'sub_title', 'description', 'slug', 'lang', 'profile_id'];
}
