<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
		'category_id', 'material_id', 'name', 'price', 'description', 'quantity', 'image_names', 'original_image_names', 'iamge_mimes',
	];

	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}

	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function material()
	{
		return $this->belongsTo('App\Material');
	}

	public function cart()
	{
		return $this->hasOne('App\Cart');
	}

	public function wishlist()
	{
		return $thsi->hasOne('App\Wishlist');
	}

	public function order()
	{
		return $this->hasMany('App\Order');
	}
}
