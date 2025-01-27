<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reactions extends Model
{
    use HasFactory;
    public function immobilier()
    {
        return $this->belongsTo(Immobilier::class);
    }
}
