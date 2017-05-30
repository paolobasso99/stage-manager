<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtime extends Model
{
    protected $fillable = ['site_id', 'start_at', 'end_at'];

    //Relation with sites table
    public function site(){
        return $this->belongsTo(Site::class);
    }
}
