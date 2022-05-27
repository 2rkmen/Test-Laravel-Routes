<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $slug;
    public $body;

    public function __construct($title, $excerpt, $date, $body, $slug )
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->slug = $slug;
        $this->body = $body;
    }


    public static function all(){
        $files = File::files(resource_path("posts/"));
        return array_map(fn($file) => $file->getContents(), $files);

    }

    public static function find($slug){
        if(!file_exists($path = resource_path("posts/{$slug}.html"))){
//            return redirect('/');
            throw new ModelNotFoundException();
        }

        //в php7.4 и выше появились стрелочные функции. они могут дергать переменные из родительской области видимости по умолчанию
        // fn()=>
        return cache()->remember("posts.{$slug}", now()->addMinutes(2), fn()=>file_get_contents($path));

    }
}
