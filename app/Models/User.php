<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Roles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function appointments(){
        return $this->hasMany(Appointment::class,'therapist');
    }

    public function role(){
        return $this->belongsTo(Roles::class,'role_id');
    }
    /*public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }*/

    static public function is_admin($role_id=NULL){

        $rid= $role_id==NULL ? auth()->user()->role_id : $role_id;  //if no value is passed to role_id,the func assumes it should use the role_id of the logged_in user  

        return $rid==Roles::ADMIN;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

    public const FROMDATE='1970-03-18 12:29:10'; //default range dates
    public const TODATE='3070-03-18 12:29:10';

}
