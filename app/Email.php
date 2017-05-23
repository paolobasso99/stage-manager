<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public function sites()
    {
        return $this->morphToMany('App\Site', 'notificable');
    }
}
