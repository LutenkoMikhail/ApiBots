<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    protected $fillable = [
        'id', 'name','description','user_id'
    ];
    public function user()
    {
        return $this->hasMany(\App\User::class);
    }
}
