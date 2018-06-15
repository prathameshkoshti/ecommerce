<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
		'name',
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

	public function quantity()
	{
		return $this->hasMany('App\Product');
	}
}
