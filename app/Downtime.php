<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downtime extends Model
{
    protected $fillable = ['site_id', 'start_at', 'end_at'];

    public function site(){
        return $this->belongsTo(Site::class);
    }
}
