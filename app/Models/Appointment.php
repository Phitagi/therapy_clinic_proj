<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Appointment extends Model
{
    use HasFactory;

    public function therapist(){
        return $this->belongsTo(User::class,'therapist_id');
    }

    public function therapyRoom(){
        return $this->belongsTo(Therapy_room::class);
    }

    static public function canUpdate(){ //custom permission
        return USER::is_admin(auth()->user()->id);
    }

    protected $fillable = [
        'name','description','therapist_id','therapy_room_id','start_at','ended_at','status',
    ];
}
