<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Notifications\NewMessageNotification;


class Messages extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($message) {
            $manager = User::where('role', 'Manager')->first(); // Trouver le premier manager disponible
            if ($manager) {
                $manager->notify(new NewMessageNotification($message));
            }
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class,'id');
    }
    public function conversation()
    {
        return $this->belongsTo(conversations::class,'conversation_id');
    }
}
