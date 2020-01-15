<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;

class Tags extends Model
{
    protected $fillable = ['name'];

    public function post()
    {
        return $this->belongsToMany(Posts::class, 'post_tag');
    }
}
