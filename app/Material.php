<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
		'name', 'status', 'created_by', 'updated_by'
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
		return $this->hasOne('App\Product');
	}
}
