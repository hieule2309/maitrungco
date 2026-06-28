<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{
    protected $fillable = ['filter_group_id', 'value', 'slug'];

    /**
     * Filter groups
     */
    public function filterGroup()
    {
        return $this->belongsTo(FilterGroup::class, 'filter_group_id');
    }

    /**
     * Products
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'filter_value_product');
    }

    public function group()
    {
        return $this->belongsTo(FilterGroup::class, 'filter_group_id');
    }

}
