<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Messages;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Notifications;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\Answer;
use App\Models\Conversations;









//use  App\Models\Notifications;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        

       // $messages = Messages::all();
        $messages = Messages::all();
        $answers = Answer::all();
        $users = [];
        foreach ($messages as $message) {
            $user = $message->user;
    
            if ($user) {
                $users[] = $user;
            }
        }
        //$users = User::all();
      /*  $user = User::find(11);
        $notifications = Notifications::all();
        $manager = User::where('role', 'Manager')->first();
        if ($manager) {
            $manager->notify(new NewMessageNotification($messages));
        }
        //$notifications = $user->unreadNotifications;
 
        foreach ($user->notifications as $notification) {
        echo $notification->type;
        }
        */
        //return view('messages.index')->with('messages',$messages,'notifications',$notifications);
      //  return view('messages.index', compact('messages', 'notifications','user'));
      return view('messages.index', compact('messages','users'));


    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $managers = User::where('role', 'Manager')->get(); // Récupérez les utilisateurs avec le rôle "Manager"
        //$home_seekers = User::where('role', 'Home seeker')->get(); 
        //$owners = User::where('role', 'Property owner')->get(); 
        return view('messages.create', ['users' => $users, 'managers' => $managers]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
    $message = new Messages();
    $user = Auth::user();
    $manager = User::where('role', 'Manager')->first();

    $emetteur_id = $user->id;  
    $manager_id = $request->input('manager_id');
    $user_id = $request->input('user_id');  
  
    if($user_id){
        $message->recepteur_id = $user_id;
    }
    else if($manager_id){
        $message->recepteur_id = $manager_id;
    }

//$emetteur_id : authenticated user id
$conversation = Conversations::where('user1_id',$emetteur_id)
                              ->orWhere('user1_id', $message->recepteur_id)
                              ->where('user2_id',$emetteur_id)
                              ->orWhere('user2_id', $message->recepteur_id)
                              ->first();
    if(!$conversation){
        $conversation = new Conversations();
        $conversation->user1_id = $emetteur_id;
        $conversation->user2_id = $message->recepteur_id;
        $conversation->save();

    }


    $message->conversation_id = $conversation->id;
   
    $message->message_content = $request->input('message_content');  // $validatedData['message_content'];
    $message->emetteur_id = $emetteur_id;
    

    $message->message_titre = $request->input('message_titre'); //$validatedData['message_titre'];
    $message->save();
    $notificationData = [
        'id' => Str::uuid(), // Ajoutez cette ligne pour spécifier une valeur pour l'ID
        'data' => json_encode([
            'message_titre' => $message->message_titre,
            'message_content' => $message->message_content,
        ]),
        'type' => 'Messages',
        'notifiable_id' => $message->id, // L'identifiant du message nouvellement inséré
        'notifiable_type' => 'Messages'
    ];

    
    //DB::table('notifications')->insert($notificationData);
   // Notifications::create($notificationData);
   DB::table('notifications')->insert($notificationData);
   Log::info('Manager ID: ' . $manager->id);


    // Envoyer la notification au manager si nécessaire
    if ($manager) {
        $manager->notify(new NewMessageNotification($message));
        Log::info('Notification envoyée au manager');

    }else{
        Log::info('Manager introuvable');

    }

    // Redirection ou réponse de confirmation
    return redirect()->route('get_message')->with('success', 'message created successfully!');
}
   
    

  
    public function destroy(string $id)
    {
        $message=Messages::findOrFail($id);
        $message->delete();
        return redirect()->route('get_message')->with('success', 'Immobilier created successfully!');
    }

    function get_my_messages(){
        $user = Auth::user();

        $messages = Messages::where('emetteur_id', $user->id)
        ->orWhere('recepteur_id', $user->id)
        ->with('answers')
        ->get();

        return view('messages.get_my_messages',compact('messages'));
}
   
}
