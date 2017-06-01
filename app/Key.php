<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Key extends Model
{
    use SoftDeletes;

    //Relation with sites table
    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    //Check if a key exist
    public static function exist($id)
    {
        return Key::where('id', '=', $id)->exists();
    }
}
