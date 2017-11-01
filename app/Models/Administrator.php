<?php

namespace App\Models;

use App\HasRoles;
use App\Role;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model implements AuthenticatableContract
{
    use Authenticatable, HasRoles;

	protected $with = ['roles'];
    protected $fillable = [
        'username', 'password', 'name',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function projects()
	{
		return $this->belongsToMany(Project::class);
	}

    public function setRolesAttribute($roles)
    {
        $this->roles()->detach();
        if ( ! $roles) return;
        if ( ! $this->exists) $this->save();

        $this->roles()->attach($roles);
    }

	public function setProjectsAttribute($values)
	{
		$this->projects()->detach();
		if ( ! $values) return;
		if ( ! $this->exists) $this->save();

		$this->projects()->attach($values);
	}

    public function setPasswordAttribute($value)
    {
        if ( ! empty($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }

	public function hasRoleFix($role){
		return $this->roles->filter(function($item) use($role){
			return $item['name'] == $role;
		})->count();
	}

	public function isSuperAdmin()
	{
		return $this->hasRoleFix('admin');
	}
}
