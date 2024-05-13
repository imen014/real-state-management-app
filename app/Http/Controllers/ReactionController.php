<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reactions;
use Illuminate\Support\Facades\Auth;
use App\Models\Immobilier;
use Illuminate\Support\Facades\Redirect;




class ReactionController extends Controller
{
   
    public function like(Request $request)
    {
        $user = Auth::user();
        $immobilier_id = $request->immobilier_id;
        $existing_reaction = Reactions::where('user_id', $user->id)
            ->where('immobilier_id', $immobilier_id)
            ->first();
    
        $immobilier = Immobilier::find($immobilier_id); // Récupérer l'immobilier correspondant
    
        if (!$user) {
            $message = 'Unauthenticated user';
        } else if ($existing_reaction) {
            // Check if the existing reaction is already a like
            if ($existing_reaction->reaction_name === 'like') {
                // If the existing reaction is a like, remove the like
                $existing_reaction->delete();
                $classe = "";
            } else {
                $existing_reaction->reaction_name = 'like';
                $classe = "bi bi-hand text-danger fs-2";
                $existing_reaction->save();
            }
        } else {
            // If the user has not already reacted, create a new like reaction
            $reaction = new Reactions();
            $reaction->user_id = $user->id;
            $reaction->immobilier_id = $immobilier_id;
            $reaction->reaction_name = 'like';
            $reaction->save();
            $classe = "bi bi-hand text-danger fs-2";
        }
    
    
        return redirect()->route('show_immo', ['id' => $immobilier_id])->with('classe', $classe);
   
    
    }
    

    public function dislike(Request $request)
        {
            $user = Auth::user();
            $immobilier_id = $request->immobilier_id;
            $existing_reaction = Reactions::where('user_id', $user->id)
                ->where('immobilier_id', $immobilier_id)
                ->first();
        
            $immobilier = Immobilier::find($immobilier_id); // Récupérer l'immobilier correspondant
        
            if (!$user) {
                $message = 'Unauthenticated user';
            } else if ($existing_reaction) {
                // Check if the existing reaction is already a like
                if ($existing_reaction->reaction_name === 'dislike') {
                    // If the existing reaction is a like, remove the like
                    $existing_reaction->delete();
                    $classe = "";
                } else {
                    $existing_reaction->reaction_name = 'dislike';
                    $classe = "bi bi-hand-fill text-danger fs-2";
                    $existing_reaction->save();
                }
            } else {
                // If the user has not already reacted, create a new like reaction
                $reaction = new Reactions();
                $reaction->user_id = $user->id;
                $reaction->immobilier_id = $immobilier_id;
                $reaction->reaction_name = 'dislike';
                $reaction->save();
                $classe = "bi bi-hand-fill text-danger fs-2";
            }
        
       
            return redirect()->route('show_immo', ['id' => $immobilier_id])->with('classe', $classe);
       
        
        }
        
   
public function heart(Request $request)
{
    $user = Auth::user();
    $immobilier_id = $request->immobilier_id;
    $existing_reaction = Reactions::where('user_id', $user->id)
        ->where('immobilier_id', $immobilier_id)
        ->first();

    $immobilier = Immobilier::find($immobilier_id); // Récupérer l'immobilier correspondant

    if (!$user) {
        $message = 'Unauthenticated user';
    } elseif ($existing_reaction) {
        // Check if the existing reaction is already a like
        if ($existing_reaction->reaction_name === 'heart') {
            // If the existing reaction is a like, remove the like
            $existing_reaction->delete();
            $classe = "";
        } else {
            $existing_reaction->reaction_name = 'heart';
            $classe = "bi bi-heart-fill text-danger fs-2";
            $existing_reaction->save();
        }
    } else {
        // If the user has not already reacted, create a new like reaction
        $reaction = new Reactions();
        $reaction->user_id = $user->id;
        $reaction->immobilier_id = $immobilier_id;
        $reaction->reaction_name = 'heart';
        $reaction->save();
        $classe = "bi bi-heart-fill text-danger fs-2";
    }

return redirect()->route('show_immo', ['id' => $immobilier_id])->with('classe', $classe);


}



    public function calculateReactions()
    {
        $immobiliers = Immobilier::all();

        // Initialisation des tableaux pour stocker les nombres de likes, dislikes et hearts
        $num_likes = [];
        $num_dislikes = [];
        $num_hearts = [];

        // Pour chaque immobilier, compter le nombre de réactions de chaque type
        foreach ($immobiliers as $immobilier) {
            $num_likes[$immobilier->id] = Reactions::where('immobilier_id', $immobilier->id)
                ->where('reaction_name', 'like')
                ->count();

            $num_dislikes[$immobilier->id] = Reactions::where('immobilier_id', $immobilier->id)
                ->where('reaction_name', 'dislike')
                ->count();

            $num_hearts[$immobilier->id] = Reactions::where('immobilier_id', $immobilier->id)
                ->where('reaction_name', 'heart')
                ->count();
        }

        return compact('num_likes', 'num_dislikes', 'num_hearts');
    }
    function actual_reaction(){
        $classe="bi bi-hand-thumbs-up-fill";
       // return view('immobiliers.actual_reaction',['classe'=>$classe]);
    }
  
}
