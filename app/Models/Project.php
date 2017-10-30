<?php

namespace App\Models;

use AdminAuth;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Support\Facades\Auth;
use SleepingOwl\Admin\Traits\OrderableModel;

use Cviebrock\EloquentSluggable\Sluggable;

class Project extends BaseModel
{
    use Sluggable, SluggableScopeHelpers, OrderableModel;

	public function sluggable()
	{
		return [
			'slug' => [
				'source' => 'title'
			]
		];
	}

	public function progers()
	{
		return $this->belongsToMany(Administrator::class);
	}

	public function setTitleAttribute($value)
	{
		self::saved(function($node) {
			if(!AdminAuth::user()->projects->filterFix('id', '=', $this->id)->count())
				AdminAuth::user()->projects()->attach($this);
		});
		$this->attributes['title'] = $value;
	}
}
