<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Downtime extends Model
{
    use SoftDeletes;

    protected $fillable = ['site_id', 'start_at', 'end_at'];

    //Relation with sites table
    public function site(){
        return $this->belongsTo(Site::class);
    }
}
