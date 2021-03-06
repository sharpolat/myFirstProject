<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategories extends Model
{
  use SoftDeletes;
  protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];
}
