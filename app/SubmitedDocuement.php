<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmitedDocuement extends Model
{
   protected $fillable=['total_price','user_id','auction_id'];
    //
    public function author_info(){
        return $this->hasOne('App\User','id','user_id');
    }
}
