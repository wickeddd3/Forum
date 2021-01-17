<?php

namespace App\Http\Controllers;

use App\Interfaces\ChannelRepositoryInterface;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    protected $channelRepository;

    public function __construct(ChannelRepositoryInterface $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }
    public function index()
    {
        $this->channelRepository->index();
    }
}
