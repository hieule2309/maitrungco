<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterValue extends Model
{
    /**
     * Filter groups
     */
    public function filterGroup()
    {
        return $this->belongsTo(FilterGroup::class, 'filter_group_id');
    }
}
