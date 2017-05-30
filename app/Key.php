<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
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
