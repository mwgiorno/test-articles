<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Bouncer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10)->create();

        Bouncer::assign('admin')->to($users->modelKeys());

        $sections = Section::factory(10)->create();

        for($i = 0; $i < 10; $i++) {
            Article::factory()
                ->for($users->random())
                ->published()
                ->hasAttached($sections->random(2))
                ->create();
        }
    }
}
