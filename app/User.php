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

	public function cartsCreatedBy()
	{
		return $this->hasMany('App\Cart', 'created_by', 'id');
	}

	public function cartsUpdatedBy()
	{
		return $this->hasMany('App\Cart', 'updated_by', 'id');
	}

	public function materialsCreatedBy()
	{
		return $this->hasMany('App\Material', 'created_by', 'id');
	}

	public function materialsUpdatedBy()
	{
		return $this->hasMany('App\Material', 'updated_by', 'id');
	}

	public function ordersCreatedBy()
	{
		return $this->hasMany('App\Order', 'created_by', 'id');
	}

	public function ordersUpdatedBy()
	{
		return $this->hasMany('App\Order', 'updated_by', 'id');
	}

	public function shippingsCreatedBy()
	{
		return $this->hasMany('App\Shipping', 'created_by', 'id');
	}

	public function shippingsUpdatedBy()
	{
		return $this->hasMany('App\Shipping', 'updated_by', 'id');
	}

	public function wishlistsUpdatedBy()
	{
		return $this->hasMany('App\Wishlist', 'updated_by', 'id');
	}

	public function wishlistsCreatedBy()
	{
		return $this->hasMany('App\Wishlist', 'created_by', 'id');
	}

	public function productsCreatedBy()
	{
		return $this->hasMany('App\Product', 'created_by', 'id');
	}

	public function productsUpdatedBy()
	{
		return $this->hasMany('App\Product', 'updated_by', 'id');
	}

	public function cart()
	{
		return $this->hasMany('App\Cart');
	}

	public function wishlist()
	{
		return $this->hasMany('App\Wishlist');
	}

	public function shipping()
	{
		return $this->hasMany('App\Shipping');
	}

	public function order()
	{
		return $this->hasMany('App\Order');
	}
}
