<?php

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

Route::get('/', function () {
    return view('posts', [
        'posts' => \App\Models\Post::all()
    ]);
});

Route::get('posts/{post}', function ($slug) {
    //найти пост по названию и передаем на вью с именем 'post'
    $post = \App\Models\Post::find($slug);
    return view('post', [
        'post' => $post]
    );

//фильтрация переменной post с регуляркой
// есть еще хелперы whereAlpha(), whereNumeric, whereAlphaNumeric
})->where('post', '[A-z_\-]+');
