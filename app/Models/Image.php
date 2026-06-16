<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'value',
        'imageable_id',
        'imageable_type'
    ];

    /**
     * Morphto
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Get full url for image
     *
     * @return Attribute
     */
    protected function url(): Attribute
    {
        return Attribute::get(function () {
            return Storage::url("images/{$this->imageable_type}/{$this->imageable_id}/{$this->value}");
        });
    }
}
