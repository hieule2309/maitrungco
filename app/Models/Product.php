<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'price', 'active'];

    protected $casts = [
        'price'  => 'decimal:2',
        'active' => 'boolean',
    ];


    protected $appends = [
        'thumbnail_url',
        'image_urls'
    ];

    /**
     * Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
    /**
     * Images
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('sort', 'asc');
    }

    /**
     * Filter values
     */
    public function filterValues()
    {
        return $this->belongsToMany(FilterValue::class, 'filter_value_product');
    }

    /**
     * Scope active product
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', true);
    }

    /**
     * Get list images product
     *
     * @return Attribute
     */
    protected function imageUrls(): Attribute
    {
        return Attribute::get(function () {
            if ($this->images->isNotEmpty()) {
                return $this->images->map(fn($image) => $image->url)->toArray();
            }

            return [asset('images/no-image.png')];
        });
    }

    /**
     * Get product thumbnail image
     *
     * @return Attribute
     */
    protected function thumbnailUrl(): Attribute
    {
        return Attribute::get(function () {
            $firstImage = $this->images->first();

            return $firstImage ? $firstImage->url : asset('images/no-image.png');
        });
    }

    /**
     * Format product price
     *
     * @return Attribute
     */
    protected function formattedPrice(): Attribute
    {
        return Attribute::get(function () {
            return number_format($this->price, 0, ',', '.') . ' đ';
        });
    }

    protected function sampleCategory(): Attribute
    {
        return Attribute::get(function () {
            return 'Linh kiện máy tính';
        });
    }

    /**
     * Get list main category product
     *
     * @return Attribute
     */
    protected function mainCategory(): Attribute
    {
        return Attribute::get(function () {
            if ($this->categories->isEmpty()) {
                return null;
            }

            $parentIds = $this->categories->pluck('parent_id')->filter()->unique()->toArray();

            $mainCategories = $this->categories->filter(function ($category) use ($parentIds) {
                return !in_array($category->id, $parentIds);
            });

           return $mainCategories;
        });
    }
}
