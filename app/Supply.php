<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $fillable = ['inventary_id', 'user_id', 'mount'];

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
