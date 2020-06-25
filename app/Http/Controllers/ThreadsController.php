<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Thread;
use App\Channel;

class ThreadsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($channel = null)
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

        if(request()->wantsJson()) {
            return response()->json([
                'threads' => $threads,
            ]);
        }

        return view('threads.index')
            ->with('channels', Channel::all())
            ->with('channel', $chan)
            ->with('threads', $threads);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create')->with('channels', Channel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'channel' => 'required|exists:channels,id'
        ]);

        Thread::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel,
            'created_at' => Carbon::now()
        ]);

        return redirect('/threads/latest');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel, Thread $thread)
    {
        if(auth()->check()) {
            auth()->user()->read($thread);
        }
        return view('threads.show')->with('thread', $thread);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel, Thread $thread)
    {
        $this->authorize('edit', $thread);

        return view('threads.edit')->with('thread', $thread)->with('channels', Channel::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'channel' => 'required|exists:channels,id'
        ]);

        $thread->update([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel,
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
