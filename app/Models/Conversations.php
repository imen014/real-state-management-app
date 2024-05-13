<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Messages;

class Conversations extends Model
{
    use HasFactory;
    public function messages()
    {
        return $this->hasMany(Messages::class);
    }
}
