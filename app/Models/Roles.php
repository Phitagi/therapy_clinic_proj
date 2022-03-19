<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasMany(User::class,'role_id');
    }

    protected $fillable = [
        'name'
    ];

    public const ADMIN=1;
    public const THERAPIST=2;

}
