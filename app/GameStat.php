<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameStat extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'formula', 'before_text', 'after_text', 'decimal_places',
    ];

}
