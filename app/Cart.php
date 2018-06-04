<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
		'product_id', 'user_id', 'quantity',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by');
	}

	public function updatedBy()
	{
		return $this->belongsTo('App\User', 'updated_by');
	}
}
