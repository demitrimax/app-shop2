<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','description'];
    public static $messages = [
            'name.required' => 'Es necesario ingresar un nombre para la categoría.',
            'name.min' => 'El nombre de la categoría debe contener almenos 3 caracteres.',
            'description.max' => 'La descripción solo admite 250 caracteres.',

        ];
        //validar los datos
    public static $rules = [
            'name' => 'required|min:3',
            'description' => 'max:250'
        ];
    
    // $category->products
    public function products() 
    {
    	return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
    	$featuredProduct = $this->products()->first();
    	return $featuredProduct->featured_image_url;
    }
}
