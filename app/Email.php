<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;

    protected $fillable = ['address'];

    //Relation with sites table
    public function sites()
    {
        return $this->belongsToMany(Site::class, 'email_site');
    }
}
