<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pics extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','search','caption', 'link', 'lat', 'lng'];
}
