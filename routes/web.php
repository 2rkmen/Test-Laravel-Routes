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

Route::get('/', function () {
    $files = File::files(resource_path("posts"));
    $posts = [];

    foreach ($files as $file){
        $document = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file);
        $posts[] = new Post(
            $document->title,
            $document->excerpt,
            $document->date,
            $document->body(),
            $document->slug,

        );
    }

//    ddd($posts);
    return view('posts', [
        'posts' => $posts
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
