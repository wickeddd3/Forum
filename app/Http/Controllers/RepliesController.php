<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyStoreRequest;
use App\Http\Requests\ReplyUpdateRequest;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\Reply;
use App\Repositories\ReplyRepositoryInterface;

class RepliesController extends Controller
{
    protected $replyRepository;

    public function __construct(ReplyRepositoryInterface $replyRepository)
    {
        $this->middleware(['auth', 'verified'])->except('index');

        $this->replyRepository = $replyRepository;
    }

    public function index(Channel $channel, Thread $thread)
    {
        return $thread->replies()->with('owner.profile')->get();
    }

    public function store(Channel $channel, Thread $thread, ReplyStoreRequest $request)
    {
        $reply = $this->replyRepository->create($thread, $request);

        if(request()->expectsJson()) {
            return $reply->load('owner.profile');
        }
    }

    public function update(ReplyUpdateRequest $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $this->replyRepository->update($reply, $request);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        if(request()->expectsJson()) {
            return response(['status' => 'Reply deleted']);
        }

        return back();
    }

}
