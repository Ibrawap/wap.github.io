<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Album extends Model
{
	protected $guarded = [];

	protected $casts = [
		'released_date'=> 'datetime'
	];

	public static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            Storage::delete($model->thumbnail);
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


    public function songs()
	{
		return $this->hasMany(Song::class);
	}

	public function artiste(){}

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function views()
    {
        return $this->morphMany(View::class,'viewable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function getThumbnailUrlAttribute()
    {
        return (Storage::exists($this->thumbnail) )
            ? asset(Storage::url($this->thumbnail))
            : asset("images/none.jpg");
    }

    public function getPermalinkAttribute()
    {
        return route('albums.show', [$this->id, $this->slug]);
    }
}
