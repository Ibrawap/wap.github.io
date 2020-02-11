<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class SongCategory extends Model
{
   protected $guarded = [];

    public function setTitleAttribute($value)
    {
    	$this->attributes['title'] = strtolower($value);
    	$this->attributes['slug'] = Str::slug($value, '-');
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'category_id');
    }
}
