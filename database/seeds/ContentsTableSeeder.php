<?php

use Illuminate\Database\Seeder;
use App\Content;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Content::create([
            'user_id' => 1,
            'src' => 'https://teramotodaiki.github.io/h4p/dist/',
            'title' => 'Feeles Example',
            'description' => '......Here is a description......',
        ]);
    }
}
