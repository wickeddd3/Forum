<?php

namespace App\Http\Controllers;

use App\Models\Reply;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->like();

        return back();
    }

    public function destroy(Reply $reply)
    {
        $reply->unlike();
    }
}
