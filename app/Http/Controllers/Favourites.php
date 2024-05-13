<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Models\Immobilier;


use Illuminate\Support\Facades\Auth;

class Favourites extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function favoris()
    {
        $user = Auth::user();
        $favourites = Favourite::where('user_id', $user->id)->get();
    
        // Créer un tableau pour stocker les détails de l'immobilier pour chaque favori
        $immobiliers = [];
    
        // Récupérer les détails de l'immobilier pour chaque favori
        foreach ($favourites as $favourite) {
            $immobilier = Immobilier::find($favourite->immobilier_id);
            if ($immobilier) {
                $immobiliers[] = $immobilier;
            }
        }
    
        return view('users.favourites', compact('favourites', 'immobiliers'));   
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $valid_favourite = $request->validate([
            'immobilier_id'=>'integer|required'
        ]);
        $user = Auth::user();
        $user_id = $user->id;  
        $immobilier_id = $valid_favourite['immobilier_id']; 

        $immobilier = Immobilier::findOrFail($immobilier_id);
        $favourite = new Favourite();
        $favourite->user_id = $user_id;
        $favourite->immobilier_id = $immobilier_id;
        $favourite->save();
        return response()->json('favourite saved succefully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $favourite = Favourite::findOrFail($id);
        $favourite->delete();
        return redirect()->route('favourites');

    }
}
