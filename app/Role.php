<?php namespace App;

namespace App;

use App\Models\BaseModel;

class Role extends BaseModel
{
	public function users()
	{
		return $this->belongsToMany(User::class);
	}
}