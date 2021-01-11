<?php

namespace App\Interfaces;

interface ReplyRepositoryInterface
{
    public function index(object $thread);

    public function create(object $thread, object $request);

    public function update(object $reply, object $request);
}
