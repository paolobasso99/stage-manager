<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Site;
use App\Key;

class Server extends Model
{
    //Relation with servers table
    public function sites(){
        return $this->hasMany(Site::class);
    }

    //Relation with keys table
    public function key(){
        return $this->belongsTo(Key::class);
    }
}
