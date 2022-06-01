<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //это обратное fillable
    protected $guarded = ['id'];
    // это для секьюрности
    // по умолчанию - запрещено массовое назначение
    // если поле не указано в $fillable - поле тупо не записывается
    //  $flight = Flight::create([
    //    'name' => 'London to Paris',
    //]);
    protected $fillable = ['title','excerpt', 'body'];

//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }


}
