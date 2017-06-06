<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Server;

class Key extends Model
{
    use SoftDeletes;

    protected $table = 'keys';

    //Relation with sites table
    public function sites()
    {
        return $this->hasMany(Server::class, 'key_id');
    }

    //Check if a key exist
    public static function exist($id)
    {
        return Key::where('id', '=', $id)->exists();
    }
}
