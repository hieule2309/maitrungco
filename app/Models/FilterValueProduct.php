<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilterValueProduct extends Model
{
    public $timestamps = false;
    protected $table = 'filter_value_product';
    protected $fillable = ['product_id', 'filter_value_id'];
}
