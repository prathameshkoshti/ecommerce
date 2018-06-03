<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
		'product_id', 'user_id', 'shipping_id', 'quantity',
		'size', 'price', 'order_date', 'delivery_status',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function shipping()
	{
		return $this->belongsTo('App\Shipping');
	}
}
