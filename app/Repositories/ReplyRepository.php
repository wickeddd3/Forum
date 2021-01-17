<?php

namespace App\Repositories;

use App\Interfaces\ReplyRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReplyRepository implements ReplyRepositoryInterface
{
    public function index($thread)
    {
        $bestReply = $thread->replies()->with('owner')->where('id', $thread->best_reply_id)->get()->toArray();
        $otherReplies = $thread->replies()->with('owner')->where('id', '!=', $thread->best_reply_id)->get()->toArray();

        $replies = array_merge($bestReply, $otherReplies);

        return $replies;
    }

    public function create($thread, $request)
    {
        return $thread->addReply([
            'message' => $request->message,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);
    }

    public function update($reply, $request)
    {
        $reply->update([
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ]);
    }

}
