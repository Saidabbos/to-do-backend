<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    //
    protected $fillable = ['name', 'author', 'done'];
}
