<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
		'user_id', 'address', 'landmark', 'city', 'pincode', 'state', 'status', 'created_by', 'updated_by'
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function order()
	{
		return $this->hasMany('App\Order');
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
