<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['address'];

    public function sites()
    {
        return $this->belongsToMany('App\Site', 'email_site');
    }
}
