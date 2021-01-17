<?php

namespace App\Interfaces;

interface ThreadRepositoryInterface
{
    public function index(string $channel);

    public function store(object $request);

    public function update(object $thread, object $request);

    public function markAsBestReply(object $thread, object $request);

    public function closeThread(object $thread);

    public function openThread(object $thread);
}
