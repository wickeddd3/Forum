<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Channel;
use App\Thread;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ChannelTableSeeder::class);
        factory(User::class, 10)->create();
        factory(Channel::class, 10)->create();
        factory(Thread::class, 100)->create();
    }
}
