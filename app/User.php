<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *name	email	username	password	gender	photo	phone	company_name	tin_num	remember_token	created_at	updated_at	

     * @var array
     */
    protected $fillable = [
        'name', 'email', 'user_name', 'password', 'gender', 'phone ','company_name','tin_number','status','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'verfication_code'=>'',
    ];

    // public function orders(){
    //     return $this->hasMany('App\Models\Order');
    // }
    public function auctions(){
             return $this->hasMany('App\Models\Auction');
        }
        
        public function documents(){
            return $this->hasMany('App\Models\Document');
       }
       public function contract(){
        return $this->hasMany('App\Contract');
   }
   public function feedback(){
    return $this->hasMany('App\Feedback');
}
public function submitedDocument(){
    return $this->hasMany('App\SubmitedDocuement');
}
}