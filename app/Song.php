<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Song extends Model
{
    protected $guarded = [];

    protected $appends = [
        'permalink'
    ];

    protected $casts = [
        'released_date'=> 'datetime'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            Storage::delete([
                $model->thumbnail, $model->path
            ]);
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

    public function getSeoTitleAttribute($value)
    {
        $artiste = array_pop($features);

        $artiste = implode(', ', $artistes) . " and ". $artiste;

        return ucwords("{$this->artiste->nick_name} - {$this->title}");

        $values[] = implode(' and ', array_splice($artistes, -2));
        $featuring = implode(', ', $artistes);
    }

    public function artiste(){}

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function category()
	{
		return $this->belongsTo(SongCategory::class);
	}

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
        return route('songs.show', [$this->id, $this->slug]);
    }

    public function getDownloadAttribute()
    {
        return asset(Storage::url($this->path));
    }

    public function getSizeAttribute()
    {
       return Storage::size($this->path);
    }
}
