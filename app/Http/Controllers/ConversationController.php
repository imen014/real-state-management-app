<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\Answer;
use App\Models\Conversations;


class ConversationController extends Controller
{
   
    public function show(string $id)
    {
        $message = Messages::findOrFail($id);
        $conversation = Conversations::where('user1_id', $message->emetteur_id)
                                      ->orWhere('user2_id', $message->emetteur_id)
                                      ->firstOrFail();
    
        // Récupérer les messages et leurs réponses associées dans l'ordre chronologique
        $messages = Messages::where('conversation_id', $conversation->id)
                            ->with('answers')
                            ->orderBy('created_at', 'asc')
                            ->get();
    
        // Récupérer les réponses pour chaque message
        foreach ($messages as $msg) {
            $msg->answers = Answer::where('belongs_to', $msg->id)->get();
        }
    
        return view('messages.show', compact('message', 'conversation', 'messages'));
    }

  

  
   /* public function destroy(string $id)
    {
       $conversation = Conversations::where('id',$id)->first();        
       
        $messages = Messages::where('conversation_id',$id)->get();
        foreach ($messages as $message) {
            $message->answers()->delete();
            $message->delete();

        }
        if ($conversation && $conversation->messages->isEmpty()) {
            $conversation->delete();
        }
        
        return redirect()->route('get_message')->with('success', 'Conversation deleted successfully');
    }*/
    public function destroy(string $id)
{
    // Récupérer la conversation associée à l'ID de message fourni
    $conversation = Conversations::whereHas('messages', function ($query) use ($id) {
        $query->where('id', $id);
    })->first();

    if (!$conversation) {
        return redirect()->route('get_message')->with('error', 'Conversation not found');
    }

    // Récupérer tous les messages de cette conversation
    $messages = Messages::where('conversation_id', $conversation->id)->get();

    foreach ($messages as $message) {
        // Supprimer les réponses associées à chaque message
        $message->answers()->delete();
        // Supprimer le message lui-même
        $message->delete();
    }

    // Vérifier si la conversation est vide après la suppression des messages
    if ($conversation->messages()->count() === 0) {
        // Supprimer la conversation si elle est vide
        $conversation->delete();
    }

    return redirect()->route('get_message')->with('success', 'Conversation deleted successfully');
}

    
}
