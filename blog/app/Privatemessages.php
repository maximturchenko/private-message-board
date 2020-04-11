<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privatemessages extends Model
{
    protected $table = 'privatemessages';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'message'
    ];



    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
