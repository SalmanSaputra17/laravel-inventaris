<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_borrow extends Model
{
    protected $fillable = ['borrow_id', 'inventary_id', 'user_id', 'mount'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
