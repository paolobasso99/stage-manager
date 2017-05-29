<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public static function exist($id)
    {
        return Key::where('id', '=', $id)->exists();
    }
}
