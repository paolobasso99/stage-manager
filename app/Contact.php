<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email'];

    //Relation with sites table
    public function sites()
    {
        return $this->belongsToMany(Site::class, 'contact_site');
    }
}
