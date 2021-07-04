<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'age',
        'birtday',
        'sex',
        'address',
        'country',
        'phone',
        'dni',
        'password'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    # RELATIONSHIP  
    public function roles(){
       return $this->belongsToMany(Role::class);
    }
    
    public function havePermission($permission){
        
        foreach($this->roles as $role){
            if($role['full-access'] == 'yes'){
                return true; 
            }

            foreach($role->permissions as $perm){

                if($perm->slug == $permission){
                    return true; 
                }
            }
        }

        return false;

    }
}
