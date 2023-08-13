<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIs('admin', 'superadmin')
            ->active()
            ->get();
        
        $sections = Section::active()->get();

        for($i = 0; $i < 10; $i++) {
            Article::factory()
                ->for($users->random(), 'author')
                ->published()
                ->hasAttached($sections->random(2))
                ->create();
        }
    }
}
