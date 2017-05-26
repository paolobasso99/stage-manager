<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['address'];

    public function sites()
    {
        return $this->hasMany('App\Site', 'email_site');
    }
}
