<?php

namespace App\Models;

class Photo extends BaseModel
{

    protected $fillable = [
        'path',
        'photoable_id'
    ];

    public function photoable()
    {
        return $this->morphTo();
    }
}
