<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    protected $guarded = [];

    protected $with = ['user', 'comments'];

    public static function boot()
    {
    	parent::boot();

    	static::deleted(function($video) {
    		Storage::delete([$video->thumbnail, $video->path]);
    	});
    }

     public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
        $this->attributes['slug'] = Str::slug($value, '-');
    }
    
    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(VideoCategory::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class,'voteable');
    }
     public function views()
    {
        return $this->morphMany(View::class,'viewable');
    }

    public function getThumbnailUrlAttribute()
    {
    	return (Storage::exists($this->thumbnail) )
            ? asset(Storage::url($this->thumbnail))
            : asset("images/none.jpg");
    }

    public function getDownloadAttribute()
    {
        return asset(Storage::url($this->path));
    }

    public function getPermalinkAttribute()
    {
        return route('videos.show', [$this->id, $this->slug]);
    }
}
