<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['value', 'imageable_type', 'imageable_id', 'sort'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
