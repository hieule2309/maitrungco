<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    public function filterValues()
    {
        return $this->hasMany(FilterValue::class, 'filter_group_id');
    }
}
