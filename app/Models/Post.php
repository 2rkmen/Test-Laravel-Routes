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
        //по хорошему кеширование - в отдельном сервис-провайдере
        return cache()->rememberForever('posts.all', function (){
            return collect(File::files(resource_path("posts")))
                ->map(fn($file) => \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file))
                ->map(fn($document) => new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug,
                ))
                ->sortByDesc('date');
        });

    }

    public static function find($slug){
        // из всех постов, найти единственный с урлом , который совпадает с запрошенным


        return static::all()->firstWhere('slug', $slug);




    }
}
