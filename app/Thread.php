<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Thread extends Model
{
    use RecordsActivity, FilteredThreads;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected $appends = ['isFollowedTo', 'path'];

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });

    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function getPathAttribute()
    {
        return $this->path();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'thread_id');
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        $this->notifyFollowers($reply);

        return $reply;
    }

    public function notifyFollowers($reply)
    {
        $this->followers
             ->where('user_id', '!=', $reply->user_id)
             ->each
             ->notify($reply);
    }

    public function follow($userId = null)
    {
        $this->followers()->create([
            'user_id' => $userId ?: Auth::id()
        ]);
    }

    public function unfollow($userId = null)
    {
        $this->followers()
             ->where('user_id', $userId ?: Auth::id())
             ->delete();
    }

    public function followers()
    {
        return $this->hasMany(ThreadFollow::class);
    }

    public function getIsFollowedToAttribute()
    {
        return $this->followers()
                    ->where('user_id', Auth::id())
                    ->exists();
    }

    public function hasUpdatesFor($user)
    {
        $key = $user->visitedThreadCacheKey($this);

        if($this->updated_at != null) {
            return $this->updated_at > cache($key);
        } else {
            return $this->created_at > cache($key);
        }

    }

}
