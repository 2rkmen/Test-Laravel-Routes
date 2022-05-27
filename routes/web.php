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
    return view('posts');
});

Route::get('posts/{post}', function ($postname) {

    //    ddd($path);
    if(!file_exists($path = __DIR__ . "/../resources/posts/{$postname}.html")){
        return redirect('/');
    }

    //в php7.4 и выше появились стрелочные функции. они могут дергать переменные из родительской области видимости по умолчанию
    // fn()=>
    $post = cache()->remember("posts.{$postname}", now()->addMinutes(2), fn()=>file_get_contents($path));

    return view('post', ['post' => $post]);
//фильтрация переменной post с регуляркой
// есть еще хелперы whereAlpha(), whereNumeric, whereAlphaNumeric
})->where('post', '[A-z_\-]+');
