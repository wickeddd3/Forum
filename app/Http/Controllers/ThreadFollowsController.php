<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Thread;

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
