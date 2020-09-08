<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    protected $guarded = [];

     public function videos()
    {
        return $this->hasMany(Video::class, 'category_id');
    }

     public function setTitleAttribute($value)
    {
    	$this->attributes['title'] = strtolower($value);
    	$this->attributes['slug'] = Str::slug($value, '-');
    }
}
