<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // $product->category
    public function category() 
    {
    	return $this->belongsTo(Category::class);
    }

    // $product->images
    public function images() 
    {
    	return $this->hasMany(ProductImage::class);
    }
    // imagenes de productos feature_url
    public function GetFeaturedImageUrlAttribute() {
        $featuredImage=$this->images()->where('feature',true)->first();
        if(!$featuredImage){
                    $featuredImage = $this->images()->first();
        }
        if($featuredImage){
            return $featuredImage->url;
        }
        
        //default
        return '/images/products/default.gif';

    }

    public function getCategoryNameAttribute()
    {
        if ($this->category)
            return $this->category->name;

        return 'General';
    }
}
