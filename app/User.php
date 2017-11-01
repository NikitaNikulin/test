<?php

namespace App;

use App\Models\BaseModel;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;

class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
	use HasRoles, Notifiable, Authenticatable, Authorizable, CanResetPassword;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */

	protected $hidden = [
		'password', 'remember_token',
	];

	public function setRolesAttribute($roles)
	{
		$this->roles()->detach();
		if ( ! $roles) return;
		if ( ! $this->exists) $this->save();

		$this->roles()->attach($roles);
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