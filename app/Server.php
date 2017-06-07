<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Site;
use App\Key;

class Server extends Model
{
    use SoftDeletes;

    //Relation with servers table
    public function sites(){
        return $this->hasMany(Site::class);
    }

    //Relation with keys table
    public function key(){
        return $this->belongsTo(Key::class);
    }
}
