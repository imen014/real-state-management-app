<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Immobilier extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_type',
        'message',
        'piece_number',
        'type',
        'price',
       // 'real_estate_image_req',
       // 'real_estate_image_opt1',
       // 'real_estate_image_opt2',
      //  'real_estate_image_opt3',
        'address',
        'latitude',
        'longitude',
        'surface_habitable',
        'surface_terrain',
        'annee_construction',
        'description',
        'has_pool',
        'has_garden',
        'has_garage'
    ];
     /**
     * Get the user that owns the immobiler.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    protected $policy = [
        ImmoPolicy::class,
    ];
    /*
    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }
    */
}
