<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    protected $fillable = ['name', 'slug'];

    public function values()
    {
        return $this->hasMany(FilterValue::class);
    }

    public function filterValues()
    {
        return $this->hasMany(FilterValue::class, 'filter_group_id');
    }
}
