<?php

namespace App\Http\Controllers;

use App\Interfaces\ThreadRepositoryInterface;
use App\Http\Requests\ThreadStoreRequest;
use App\Http\Requests\ThreadUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Channel;


class ThreadController extends Controller
{
    protected $threadRepository;

    public function __construct(ThreadRepositoryInterface $threadRepository)
    {
        $this->middleware(['auth', 'verified'])->except('index', 'show');

        $this->threadRepository = $threadRepository;
    }

    public function index($channel = null)
    {
        $threads = $this->threadRepository->all($channel);

        if(request()->wantsJson()) {
            return response()->json([
                'threads' => $threads['threads'],
            ]);
        }

        return view('threads.index')
            ->with('channels', Channel::all())
            ->with('channel', $threads['channel'])
            ->with('threads', $threads['threads']);
    }

    public function create()
    {
        return view('threads.create')->with('channels', Channel::all());
    }

    public function store(ThreadStoreRequest $request)
    {
        $this->threadRepository->create($request);

        return redirect('/threads/latest');
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

        return view('threads.edit')->with('thread', $thread)->with('channels', Channel::all());
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
