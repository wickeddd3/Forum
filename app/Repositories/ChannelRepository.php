<?php

namespace App\Repositories;

use App\Interfaces\ChannelRepositoryInterface;
use App\Models\Channel;

class ChannelRepository implements ChannelRepositoryInterface
{
    protected $channel;

    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function index()
    {
        return $this->channel->all();
    }
}
