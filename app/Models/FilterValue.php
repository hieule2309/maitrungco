<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{
    protected $fillable = ['filter_group_id', 'value', 'slug'];

    public function group()
    {
        return $this->belongsTo(FilterGroup::class, 'filter_group_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'filter_value_product');
    }
}
