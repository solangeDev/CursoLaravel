<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'id', 'name', 'email','phone', 'age', 'identy',
        'image','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
