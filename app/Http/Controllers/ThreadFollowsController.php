<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;

class ThreadFollowsController extends Controller
{
    public function index(Channel $channel, Thread $thread)
    {
        $thread->follow();
    }

    public function destroy(Channel $channel, Thread $thread)
    {
        $thread->unfollow();
    }
}