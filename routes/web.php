<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', 'QuestionController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('questions', 'QuestionController')->except('show');
//Route::post('/questions/{question}/answer', 'AnswerController@store')->name('answers.store');
Route::resource('questions.answers', 'AnswerController')->only('store', 'edit', 'update', 'destroy');
Route::get('/questions/{slug}', 'QuestionController@show')->name('questions.show');
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('favorite.store');
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('favorite.delete');

Route::post('/questions/{question}/vote', 'VoteQuestionController');
Route::post('/answers/{answer}/vote', 'VoteAnswerController');
