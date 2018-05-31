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
}
