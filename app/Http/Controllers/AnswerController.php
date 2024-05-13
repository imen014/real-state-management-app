<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;
use App\Models\User;




class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $msg_id = $request->input('msg_id');
        return view('answers.create', ['msg_id' => $msg_id]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $user = Auth::user();
    
    
        $answer = new Answer();
        $answer->answer_content = $request->input('answer_content');  // $validatedData['message_content'];
        $answer->emetteur_id = $user->id;
        $message_id =  $request->input('msg_id');
       // dd($message_id);
        $message = Messages::findOrFail($message_id);

        $answer->recepteur_id = $message->emetteur_id;
    
        $answer->answer_titre = $request->input('answer_titre'); //$validatedData['message_titre'];
        $answer->belongs_to = $message_id;
        $answer->save();
      //  return redirect()->route('get_message')->with('success', 'answer created successfully!');
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
        //
    }
}
