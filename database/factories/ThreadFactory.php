<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\User;
use App\Thread;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Thread::class, function (Faker $faker) {
    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
    return [
        'title' => $title,
        'content' => $faker->paragraph,
        'user_id' => function() {
            return User::all()->random();
        },
        'channel_id' => function() {
            return Channel::all()->random();
        },
        'created_at' => Carbon::now()
    ];
});
