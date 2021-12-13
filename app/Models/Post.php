<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id';
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }
    public function CategoryPost()
    {
        return $this->belongsTo(CategoryPost::class, 'categoryPost_id');
    }
}
