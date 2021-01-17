<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;

class ThreadFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Channel $channel, Thread $thread)
    {
        $thread->follow();
    }

    public function destroy(Channel $channel, Thread $thread)
    {
        $thread->unfollow();
    }
}
