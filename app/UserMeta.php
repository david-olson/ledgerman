<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'meta_type_id', 'contents',
    ];

    public function user()
    {
    	return $this->belongsTo(App\User::class);
    }

    public function metaType()
    {
    	return $this->belongsTo(MetaType::class);
    }
}
