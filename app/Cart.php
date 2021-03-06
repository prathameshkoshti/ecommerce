<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
		'quantity_id', 'user_id', 'ordered_quantity',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function quantity()
	{
		return $this->belongsTo('App\Quantity');
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
