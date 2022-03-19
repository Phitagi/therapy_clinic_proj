<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapy_room extends Model
{
    use HasFactory;

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    protected $fillable = [
        'name',
    ];
}
