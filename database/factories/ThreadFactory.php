<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Channel;
use App\Models\User;
use App\Models\Thread;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Thread::class, function (Faker $faker) {
    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
    return [
        'title' => $title,
        'content' => $faker->paragraph($nbSentences = 10),
        'user_id' => function() {
            return User::all()->random();
        },
        'channel_id' => function() {
            return Channel::all()->random();
        },
        'created_at' => Carbon::now()
    ];
});
