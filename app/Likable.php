<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Likable
{

    protected static function bootLikable()
    {
        static::deleting(function ($model) {
            $model->likes->each->delete();
        });
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    public function like()
    {
        $attributes = ['user_id' => auth()->id()];

        if(!$this->likes()->where($attributes)->exists()) {
            return $this->likes()->create($attributes);
        }

    }

    public function unlike()
    {
        $attributes = ['user_id' => auth()->id()];

        $this->likes()->where($attributes)->get()->each->delete();
    }

    public function isLiked()
    {
        return !! $this->likes()->where('user_id', auth()->id())->count();
    }

    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }
}
