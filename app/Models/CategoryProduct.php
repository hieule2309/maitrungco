<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $timestamps = false;
    protected $table = 'category_product';
    protected $fillable = ['product_id', 'category_id'];
}
