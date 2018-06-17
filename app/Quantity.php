<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quantity extends Model
{
    protected $fillable = [
		'product_id', 'size_id', 'quantity',
	];

	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}

	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function order()
	{
		return $this->hasMany('App\Order');
	}

	public function cart()
	{
		return $this->hasMany('App\Cart');
	}

	public function size()
	{
		return $this->belongsTo('App\Size');
	}
}
