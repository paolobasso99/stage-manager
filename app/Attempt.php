<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = ['site_id', 'status', 'load_time', 'message'];
}
