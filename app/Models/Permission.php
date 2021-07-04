<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    # RELATIONSHIP  
    public function roles(){
       return $this->belongsToMany(Role::class);
    }
}
