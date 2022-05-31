<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

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

Route::get('posts/', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('posts/{post}', function ($slug) {
    //найти пост по названию и передаем на вью с именем 'post'
    $post = \App\Models\Post::findOrFail($slug);
    return view('post', [
        'post' => $post]
    );

//фильтрация переменной post с регуляркой
// есть еще хелперы whereAlpha(), whereNumeric, whereAlphaNumeric
});
