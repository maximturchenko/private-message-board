<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privatemessages extends Model
{
    protected $table = 'privatemessages';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
