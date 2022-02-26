<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function ProductImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function ProductDocuments()
    {
        return $this->hasMany(ProductDocument::class, 'product_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }
    public function categorys()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
