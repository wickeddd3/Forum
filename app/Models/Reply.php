<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Traits\Likable;
use App\Traits\RecordsActivity;

class Reply extends BaseModel
{
    use Likable, RecordsActivity;

    protected $with = ['owner', 'likes', 'thread'];

    protected $appends = ['likesCount', 'isLiked'];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
        });

    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }

}
