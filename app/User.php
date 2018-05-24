<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile_no', 'updated_by', 'created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
	];

	public function categoriesCreatedBy()
	{
		return $this->hasMany('App\Category', 'created_by', 'id');
	}

	public function categoriesUpdatedBy()
	{
		return $this->hasMany('App\Category', 'updated_by', 'id');
	}

	public function materialsCreatedBy()
	{
		return $this->hasMany('App\Material', 'created_by', 'id');
	}

	public function materialsUpdatedBy()
	{
		return $this->hasMany('App\Material', 'updated_by', 'id');
	}

	public function brandsCreatedBy()
	{
		return $this->hasMany('App\Brand', 'created_by', 'id');
	}

	public function brandsUpdatedBy()
	{
		return $this->hasMany('App\Brand', 'updated_by', 'id');
	}
}
