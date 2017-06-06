<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Site;

class Server extends Model
{
    //Relation with servers table
    public function sites(){
        return $this->hasMany(Site::class);
    }
}
