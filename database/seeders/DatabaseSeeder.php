<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{

    

    public function run()

    {   Storage::deleteDirectory('public');
                Storage::makeDirectory('public');
        \App\Models\Post::factory(2)->create();
    }
}
