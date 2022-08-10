<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable=['title','description','user_id'];
    public function cat_info(){
        return $this->hasOne('App\Models\PostCategory','id','category');
    }
    public function author_info(){
        return $this->hasOne('App\User','id','user_id');
    }
    public static function getAllFeedback(){
        return Feedback::with(['cat_info','author_info'])->orderBy('id','DESC')->paginate(10);
    }
    //
}
