<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = ['site_id', 'status', 'load_time', 'message', 'certificate_validity'];

    public function site(){
        return $this->belongsTo(Site::class);
    }
}
