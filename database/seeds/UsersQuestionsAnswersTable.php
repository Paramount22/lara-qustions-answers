<?php

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Database\Seeder;

class UsersQuestionsAnswersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create()->each(function($u) {
            $u->questions()
                ->saveMany(
                    factory(Question::class, rand(1, 5))->make()
                )->each(function($q) {
                    $q->answers()->saveMany(factory (Answer::class, rand(1, 5) )->make());
                });
        });
    }
}
