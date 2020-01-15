<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categories;
use App\Tags;

class Posts extends Model
{
    protected $fillable = ['title','content','description','categories_id','image'];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tags::class, 'post_tag');
    }

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tag->pluck('id')->toArray());
    }
}
