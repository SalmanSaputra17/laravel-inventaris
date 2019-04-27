<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = ['borrow_date', 'return_date', 'user_id', 'borrow_status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
