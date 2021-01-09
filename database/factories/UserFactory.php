<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Profile;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'avatar' => 'uploads/avatars/default_avatar.png',
        // 'remember_token' => Str::random(10),
        'created_at' => Carbon::now()
    ];
});

// $factory->afterCreating(User::class, function ($user, $faker) {
//     Profile::create([
//         'user_id' => $user->id, 'created_at' => Carbon::now(),
//         'avatar' => 'uploads/avatars/default_avatar.png'
//     ]);
// });
