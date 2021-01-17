<?php

namespace App\Http\Controllers;

use App\Interfaces\ThreadRepositoryInterface;
use App\Http\Requests\ThreadStoreRequest;
use App\Http\Requests\ThreadUpdateRequest;
use App\Interfaces\ChannelRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Channel;


class ThreadController extends Controller
{
    protected $threadRepository;
    protected $channelRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository, ChannelRepositoryInterface $channelRepository)
    {
        $this->middleware(['auth', 'verified'])->except('index', 'show');

        $this->threadRepository = $threadRepository;
        $this->channelRepository = $channelRepository;
    }

    public function index($channel = null)
    {
        $threads = $this->threadRepository->index($channel);

        if(request()->wantsJson()) {
            return response()->json([
                'threads' => $threads
            ]);
        }

        return view('threads.index')
                ->with('channels', $this->channelRepository->index());
    }

    public function create()
    {
        return view('threads.create')
                ->with('channels', $this->channelRepository->index());
    }

    public function store(ThreadStoreRequest $request)
    {
        $this->threadRepository->store($request);

        return redirect('/threads');
    }

    public function show(Channel $channel, Thread $thread)
    {
        if(auth()->check()) {
            auth()->user()->read($thread);
        }
        return view('threads.show')->with('thread', $thread);
    }

    public function edit(Channel $channel, Thread $thread)
    {
        $this->authorize('edit', $thread);

        return view('threads.edit')
                ->with('thread', $thread)
                ->with('channels', $this->channelRepository->index());
    }

    public function update(ThreadUpdateRequest $request, Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->threadRepository->update($thread, $request);

        return redirect()->back();
    }

    public function markAsBestReply(Channel $channel, Thread $thread, Request $request)
    {
        $this->authorize('update', $thread);

        $this->threadRepository->markAsBestReply($thread, $request);
    }

    public function closeThread(Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->threadRepository->closeThread($thread);
    }

    public function openThread(Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->threadRepository->openThread($thread);
    }

}
