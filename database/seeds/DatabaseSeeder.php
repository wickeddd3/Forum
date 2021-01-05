<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Channel;
use App\Models\Thread;

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
