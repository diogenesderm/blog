<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;

class Categories extends Model
{
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->hasMany(Posts::class, 'categories_id');
    }
}
