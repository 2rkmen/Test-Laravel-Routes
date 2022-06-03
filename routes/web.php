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

    /*
     * чтобы выдернуть связанные записи одним запросом(чтобы не делать много запросов
     * т.е.
     * [2022-06-03 10:07:05] local.DEBUG: select * from `posts`
     * [2022-06-03 10:07:05] local.DEBUG: select * from `categories` where `categories`.`id` in (1, 2, 3)
     * вместо
     * [2022-06-03 09:46:24] local.DEBUG: select * from `posts`
     * [2022-06-03 09:46:24] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1 [1]
     * [2022-06-03 09:46:24] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1 [2]
     * [2022-06-03 09:46:24] local.DEBUG: select * from `categories` where `categories`.`id` = ? limit 1 [3]
     *  */
    return view('posts', [
        'posts' => Post::latest()->with('category', 'author')->get()
    ]);
});

Route::redirect('/','/posts');


Route::get('posts/{post:slug}', function (Post $post) {
    //найти пост по названию и передаем на вью с именем 'post'
    return view('post', [
        'post' => $post]
    );

//фильтрация переменной post с регуляркой
// есть еще хелперы whereAlpha(), whereNumeric, whereAlphaNumeric
});

Route::get('categories/{category:slug}', function (\App\Models\Category $category){
    return view('posts', [
        'posts' => $category->posts
    ]);
});

Route::get('authors/{author:username}', function (\App\Models\User $author){
    return view('posts', [
//        'posts' => $author->posts()->with('author', 'category')->get()
        'posts' => $author->posts
    ]);
});
