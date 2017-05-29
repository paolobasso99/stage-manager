<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    public function sites()
    {
        return $this->hasMany('App\Site');
    }
}
