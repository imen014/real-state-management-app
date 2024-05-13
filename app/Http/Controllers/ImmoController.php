<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immobilier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Reactions;
use App\Http\Controllers\ReactionController;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Laravel\Facades\Image;
//use Intervention\Image\Facades\Image;
use App\Models\Imagesimmobiliersupp;






class ImmoController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reactions = (new ReactionController())->calculateReactions();
        $num_likes = $reactions['num_likes'];
        $num_dislikes = $reactions['num_dislikes'];
        $num_hearts = $reactions['num_hearts'];
    
        $immobiliers = Immobilier::with('owner')->get();
    
        return view('immobiliers.index', compact('immobiliers', 'num_likes', 'num_dislikes', 'num_hearts'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('immobiliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'address.required' => 'Please enter an address.',
            'address.string' => 'The address must be a string.',
            'city.required' => 'Please choose a City.',
            'city.string' => 'The city must be a Text.',
            'annee_construction.required' => 'Please enter the year of construction.',
            'annee_construction.regex' => 'The year of construction must be a valid year (YYYY format).',
            'state.required' => 'Please choose a State.',
            'state.string' => 'The state must be a Text.',
            'price.required' => 'Please Enter the Price.',
            'surface_habitable.required' => 'Please enter the habitable surface.',
            'surface_habitable.numeric' => 'The habitable surface must be numeric.',
            'surface_terrain.required' => 'Please enter the land area.',
            'surface_terrain.numeric' => 'The land area must be numeric.',
            'price.numeric' => 'The price must numeric.',
            'piece_number.required' => 'Please Enter the room number.',
            'piece_number.numeric' => 'Room number must be numeric.',
            'real_estate_image_req.max' => 'u can upload until 3 images',

            'transaction_type.required' => 'Please Enter a transaction type.',
            'message.required' => 'Please Enter a message.',
          'description.regex' => 'The description must not contain repetitive characters.',
        ];
         $validated_data = $request->validate([
            'transaction_type' => 'required|string',
            'updater' => 'sometimes',
            'message' => 'nullable|string|regex:/^[A-Za-z0-9\s]+$/|max:255',
           'piece_number' => 'required|numeric', /**********/ 
           'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'city' => 'required|string|regex:/^[A-Za-z0-9\s]+$/|max:255',
            'state' => 'required|string|regex:/^[A-Za-z0-9\s]+$/|max:255',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric||between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'description' => 'required|string|min:50|regex:/^(?!.*(.)\1{4})/',
            'surface_habitable' => 'required|numeric|min:0',

            'surface_terrain' => 'required|numeric|min:0',
            'annee_construction' => 'required|regex:/^\d{4}$/|before_or_equal:now',
            'real_estate_image_req' => 'required|array|max:10',
            'real_estate_image_req.*' => 'image|mimes:jpeg,png|max:2048',            'surface_habitable' => 'required|numeric',
            'description' => 'required|string|regex:/^(?!.*([A-Za-z0-9\s])\1{3}).*$/'], $messages);


            $validator = Validator::make($request->all(), [
                $validated_data            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }



        $user = Auth::user();
        
        $immobilier = new Immobilier();
        $immobilier->owner_id = $user->id;
        $immobilier->fill($request->all());
        $immobilier->city = $request->input('city');
        $immobilier->state = $request->input('state');
        $immobilier->updater = '';

        $immobilier->has_pool = $request->has('has_pool') ? 1 : 0;
        $immobilier->has_garage = $request->has('has_garage') ? 1 : 0;
        $immobilier->has_garden = $request->has('has_garden') ? 1 : 0;
        $immobilier->save();
        
        if (!Storage::exists('public/real_estate_images')) {
            Storage::makeDirectory('public/real_estate_images');
        }
       
        if ($request->hasFile('real_estate_image_req')) {
            foreach ($request->file('real_estate_image_req') as $image) {
                // Enregistrez l'image dans le répertoire de stockage et récupérez le chemin
                
                $imageName = $user->name . '_' .  $immobilier->state . '_' .  $immobilier->type . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move('storage/real_estate_images', $imageName);
                $imagePath = 'storage/real_estate_images/' . $imageName;

                // Enregistrez le chemin de l'image dans la table des images
                $imageEntry = new Imagesimmobiliersupp();
                $imageEntry->immobilier_id = $immobilier->id;
                $imageEntry->image_path = $imagePath;
                $imageEntry->save();
                
            }
           
        }
        return redirect()->route('index')->with('success', 'Immobilier created successfully!');
    
        // Rediriger avec un message de succès ou d'erreur
    }    

    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $immobilier = Immobilier::findOrFail($id);
        $images = Imagesimmobiliersupp::where('immobilier_id', $immobilier->id)->get();
        return view('immobiliers.immo_detail',compact('immobilier','images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $immobilier = Immobilier::findOrFail($id);
        return view('immobiliers.edit', ['immobilier' => $immobilier]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'address.string' => 'The address must be a string.',
            'city.string' => 'The city must be a Text.',
            'annee_construction.regex' => 'The year of construction must be a valid year (YYYY format).',
            'state.string' => 'The state must be a Text.',
            'surface_habitable.numeric' => 'The habitable surface must be numeric.',
            'surface_terrain.numeric' => 'The land area must be numeric.',
            'price.numeric' => 'The price must numeric.',
            'piece_number.numeric' => 'Room number must be numeric.',
            'real_estate_image_req.max' => 'u can upload until 10 images',
          'description.regex' => 'The description must not contain repetitive characters.',
        ];
         $validated_data = $request->validate([
            'transaction_type' => 'sometimes|string',
            'message' => 'nullable|string|regex:/^[A-Za-z0-9\s]+$/|max:255',
           'piece_number' => 'sometimes|numeric', /**********/ 
           'type' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'city' => 'sometimes|string|regex:/^[A-Za-z0-9\s]+$/|max:255',
            'state' => 'sometimes|string|regex:/^[A-Za-z0-9\s]+$/|max:255',
            'address' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|numeric||between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',
            'description' => 'sometimes|string|min:50|regex:/^(?!.*(.)\1{4})/',
            'surface_habitable' => 'sometimes|numeric|min:0',
            'surface_terrain' => 'sometimes|numeric|min:0',
            'annee_construction' => 'sometimes|regex:/^\d{4}$/|before_or_equal:now',
            'real_estate_image_req' => 'sometimes|array|max:10',
            'real_estate_image_req.*' => 'image|mimes:jpeg,png|max:2048',            'surface_habitable' => 'sometimes|numeric',
            'description' => 'sometimes|string|regex:/^(?!.*([A-Za-z0-9\s])\1{3}).*$/'], $messages);


            $validator = Validator::make($request->all(), [
                $validated_data            ], $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }



        $user = Auth::user();
        
        $immobilier = Immobilier::findOrFail($id);
        $immobilier->updater = $user->id;
        $immobilier->fill($request->all());
        $immobilier->city = $request->input('city');
        $immobilier->state = $request->input('state');

        $immobilier->has_pool = $request->has('has_pool') ? 1 : 0;
        $immobilier->has_garage = $request->has('has_garage') ? 1 : 0;
        $immobilier->has_garden = $request->has('has_garden') ? 1 : 0;
        $immobilier->update();
       
        $images = Imagesimmobiliersupp::where('immobilier_id',$immobilier->id)->get();;
           
        // Supprimer les anciennes images et enregistrer les nouvelles si des images sont présentes dans la requête
        if ($request->hasFile('real_estate_image_req')) {
            $images = Imagesimmobiliersupp::where('immobilier_id', $immobilier->id)->get();
            foreach ($images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }
                $image->delete();
            }
    
            foreach ($request->file('real_estate_image_req') as $imageFile) {
                $imageName = $user->username . '_' . $immobilier->state . '_' . $immobilier->type . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = 'storage/real_estate_images/' . $imageName;
                $imageFile->move('storage/real_estate_images', $imageName);
                $image_instance = new Imagesimmobiliersupp();
                $image_instance->image_path = $imagePath;
                $image_instance->immobilier_id = $immobilier->id;
                $image_instance->save();
            }
        }
        return redirect()->route('index')->with('success', 'Immobilier created successfully!');

        
    }
    
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $immobilier = Immobilier::findOrFail($id);
        $images = Imagesimmobiliersupp::where('immobilier_id', $immobilier->id)->get();
            foreach ($images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                    $image->delete();
                }
            }
               
        $immobilier->delete();
      return redirect()->route('index')->with('success', 'Immobilier deleted successfully!');
        
    }
    

      
    

    public function back_function(): RedirectResponse
    {
            return back();
    }

   
}
