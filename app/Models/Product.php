<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'active'];

    protected $casts = [
        'price'  => 'decimal:2',
        'active' => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('sort');
    }

    public function filterValues()
    {
        return $this->belongsToMany(FilterValue::class, 'filter_value_product');
    }
}
