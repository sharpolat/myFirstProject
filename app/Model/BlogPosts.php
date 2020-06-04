<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPosts extends Model
{
    use SoftDeletes;
  protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    function public category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    function public user()
    {
        return $this->belongsTo(User::class);
    }
}
