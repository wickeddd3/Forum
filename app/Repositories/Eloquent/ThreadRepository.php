<?php

namespace App\Repositories\Eloquent;

use App\Models\Channel;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ThreadRepositoryInterface;

class ThreadRepository implements ThreadRepositoryInterface
{
    public function all($channel)
    {
        $chan = Channel::where('slug', $channel)->first();

        $threads = Thread::latest()->paginate(10);

        if($chan) {
            $threads = Thread::latest()->where('channel_id', $chan->id)->paginate(10);
        }

        switch($channel)
        {
            case "latest":
                $threads = Thread::latestThreads()->paginate(10);
            break;
            case "popular":
                $threads = Thread::popularThreads()->paginate(10);
            break;
            case "oldest":
                $threads = Thread::oldestThreads()->paginate(10);
            break;
        }

        $search = request()->query('search');

        if($search) {
            $threads = Thread::where('title', 'LIKE', "%{$search}%")->paginate(10);
            $threads->appends(['search' => $search]);
        }

        return ["channel" => $chan, "threads" => $threads];
    }

    public function create($request)
    {
        Thread::create([
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
