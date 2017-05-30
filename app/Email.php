<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['address'];
    
    //Relation with sites table
    public function sites()
    {
        return $this->belongsToMany(Site::class, 'email_site');
    }
}
