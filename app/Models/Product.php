<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Product extends Model
{
    protected $fillable = ['name', 'description', 'stock', 'price', 'image', 'category_id', 'etat'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function carts()
{
    return $this->belongsToMany(Cart::class)->withPivot('quantity')->withTimestamps();
}
}