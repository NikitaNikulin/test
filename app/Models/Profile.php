<?php

namespace App\Models;

use App\User;
use SleepingOwl\Admin\Traits\OrderableModel;

class Profile extends BaseModel
{
    use OrderableModel;

    public $fillable = [
        'user_id', 'name', 'phone', 'address', 'intercom', 'image', 'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
