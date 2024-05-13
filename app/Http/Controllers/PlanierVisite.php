<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visites;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Immobilier;





class PlanierVisite extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visites = Visites::all();
        return view('visites.index',['visites'=>$visites]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'visite_date.required' => 'Please choose a visit date.',
            'visite_date.date' => 'The visit date must be a valid date format.',
            'visite_date.after_or_equal' => 'The visit date must be today or a future date.',
            'visite_time.required' => 'Please choose a visit time.',
            'visite_time.date_format' => 'The visit time must be in HH:mm format.',
        ];
        $user = Auth::user();

        $request->validate([
        'visite_date' => 'required|date|after_or_equal:today',
        'visite_time' => 'required|date_format:H:i',
    ], [
        'visite_time.after_or_equal' => 'The visit time must be in the future.',
    ],$messages);
     // Vérification si l'utilisateur a déjà soumis une demande de visite pour cet immobilier
     $existingVisite = Visites::where('user_id', $user->id)
     ->where('immobilier_id', $request->input('immobilier_id'))
     ->exists();

    // Si une demande existe déjà, renvoyer un message d'erreur
    if ($existingVisite) {
        return redirect()->back()->withErrors(['visite_already_requested' => 'You have already requested a visit for this property.']);
    }

        $visite = new Visites();
        $visite->visite_date = $request->input('visite_date');
        $visite->visite_time = $request->input('visite_time');
        $visite->visite_state = "ask visite";
        $visite->user_id = $user->id;
        $visite->immobilier_id = $request->input('immobilier_id');
        $visite->save();
        return redirect()->route('index')->with('success', 'Immobilier created successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visite = Visites::findOrFail($id);
        $user_id = $visite->user_id;
        $user = User::findOrFail($user_id);
        $immobilier_id = $visite->immobilier_id;
        $immobilier = Immobilier::findOrFail($immobilier_id);
       // return view('visites.detail')->with('visite',$visite,'user',$user,'immobilier',$immobilier);
       return view('visites.detail',compact('visite','user','immobilier'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visite = Visites::findOrFail($id);
        $immobilier = Immobilier::findOrFail($visite->immobilier_id);
        return view('visites.edit',compact('visite','immobilier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'visite_date.required' => 'Please choose a visit date.',
            'visite_date.date' => 'The visit date must be a valid date format.',
            'visite_date.after_or_equal' => 'The visit date must be today or a future date.',
            'visite_time.required' => 'Please choose a visit time.',
            'visite_time.date_format' => 'The visit time must be in HH:mm format.',
        ];
        $user = Auth::user();

        $request->validate([
        'visite_date' => 'required|date|after_or_equal:today',
        'visite_time' => 'required|date_format:H:i',
    ], [
        'visite_time.after_or_equal' => 'The visit time must be in the future.',
    ],$messages);
     // Vérification si l'utilisateur a déjà soumis une demande de visite pour cet immobilier
   

    
        $visite = Visites::findOrFail($id);
        $visite->visite_date = $request->input('visite_date');
        $visite->visite_time = $request->input('visite_time');
        $visite->visite_state = "ask visite";
        $visite->user_id = $user->id;
        $visite->immobilier_id = $request->input('immobilier_id');
        $visite->update();
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visite = Visites::findOrFail($id);
        $visite->delete();
        return Redirect()->back();
    }
}
