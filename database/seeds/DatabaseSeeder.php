<?php

use App\Question;
use App\User;
use App\Answer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersQuestionsAnswersTable::class,
            FavoritesTableSeeder::class
        ]);

    }
}
