<?php

namespace App\Repositories;

interface ThreadRepositoryInterface
{
    public function all(string $channel);

    public function create(object $request);

    public function update(object $thread, object $request);
}
