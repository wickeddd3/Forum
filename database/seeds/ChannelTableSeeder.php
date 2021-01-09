<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('channels')->insert([
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Node.js',
                'slug' => 'nodejs',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'React.js',
                'slug' => 'reactjs',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Angular',
                'slug' => 'angular',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'ASP.Net',
                'slug' => 'aspnet',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Django',
                'slug' => 'django',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Nuxt.js',
                'slug' => 'nuxtjs',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'React Native',
                'slug' => 'react-native',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'NativeScript',
                'slug' => 'nativescript',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
