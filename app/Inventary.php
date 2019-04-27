<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventary extends Model
{
    protected $fillable = ['inventary_code', 'name', 'condition', 'mount', 'type_id', 'room_id', 'user_id', 'register_date', 'explanation'];

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
