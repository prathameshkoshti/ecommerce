<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
		'quantity_id', 'user_id', 'shipping_id', 'ordered_quantity',
		'price', 'order_date', 'delivery_status',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function quantity()
	{
		return $this->belongsTo('App\Quantity');
	}

	public function shipping()
	{
		return $this->belongsTo('App\Shipping');
	}

	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}

	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}

	public function rating()
	{
		return $this->hasOne('App\Rating');
	}
}
