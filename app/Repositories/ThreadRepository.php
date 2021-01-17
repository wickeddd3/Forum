<?php

namespace App\Repositories;

use App\Interfaces\ThreadRepositoryInterface;
use App\Models\Channel;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ThreadRepository implements ThreadRepositoryInterface
{
    protected $thread, $channel;

    public function __construct(Thread $thread, Channel $channel)
    {
        $this->thread = $thread;
        $this->channel = $channel;
    }
    public function index($channel)
    {
        $selectedChannel = $this->channel->where('slug', $channel)->first();

        $threads = $this->thread->latest()->paginate(10);

        if($selectedChannel) {
            $threads =  $this->thread->latest()->where('channel_id', $selectedChannel->id)->paginate(10);
        }

        $query = request()->query('search');

        if($query) {
            switch($query){
                case "latest":
                    $threads =  $this->thread->latestThreads()->paginate(10);
                    break;
                case "popular":
                    $threads =  $this->thread->popularThreads()->paginate(10);
                    break;
                case "oldest":
                    $threads =  $this->thread->oldestThreads()->paginate(10);
                    break;
                default:
                    $threads =  $this->thread->where('title', 'LIKE', "%{$query}%")->paginate(10);
                    $threads->appends(['search' => $query]);
            }
        }

        return $threads;
    }

    public function store($request)
    {
        $this->thread->create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel,
            'created_at' => Carbon::now()
        ]);
    }

    public function update($thread, $request)
    {
        $thread->update([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel,
            'updated_at' => Carbon::now()
        ]);
    }

    public function markAsBestReply($thread, $request)
    {
        $thread->update([
            'best_reply_id' => $request->reply_id
        ]);
    }

    public function closeThread($thread)
    {
        $thread->update([
            'closed_at' => Carbon::now()
        ]);
    }

    public function openThread($thread)
    {
        $thread->update([
            'closed_at' => null
        ]);
    }
}
