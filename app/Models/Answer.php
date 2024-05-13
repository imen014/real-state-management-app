<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
   
    public function recepteur()
    {
        return $this->belongsTo(Message::class, 'recepteur_id'); // Spécifiez le nom de la colonne de clé étrangère pour le récepteur
    }

    public function emetteur()
    {
        return $this->belongsTo(Message::class, 'emetteur_id'); // Spécifiez le nom de la colonne de clé étrangère pour l'émetteur
    }
}
