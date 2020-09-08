<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $guarded = [];

    public function setTitleAttribute($value)
    {
    	$this->attributes['title'] = strtolower($value);
    	$this->attributes['slug'] = Str::slug($value, '-');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
