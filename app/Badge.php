<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'conditions',
    ];

    public function users()
    {
    	return $this->belongsToMany(App\User::class);
    }

    public function meta()
    {
    	return $this->hasMany(App\BadgeMeta::class);
    }

}
