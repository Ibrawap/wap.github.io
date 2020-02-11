<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    protected $with = ['user', 'votes'];

    protected $appends = ['created_at'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public function votes()
    {
        return $this->morphMany(Vote::class,'voteable');
    }

    public function getCreatedAtAttribute($value)
    {
        return (new \Carbon\Carbon($this->attributes['created_at']))->diffForHumans();
    }
}
