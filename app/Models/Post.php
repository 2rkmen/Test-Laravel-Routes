<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author()
    {
        //когда нужно дернуть поле с названием, не совпадающем с внешним ключом
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        //belongs to
        return $this->belongsTo(Category::class);
    }

}
