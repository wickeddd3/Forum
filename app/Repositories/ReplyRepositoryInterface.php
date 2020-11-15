<?php

namespace App\Repositories;

interface ReplyRepositoryInterface
{
    public function create(object $thread, object $request);

    public function update(object $reply, object $request);
}
