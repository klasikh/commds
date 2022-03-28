<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\ChatMessageEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $user_id = auth()->user()->id;

        return Inertia::render('Message/Index', [
            'user' => $user,
            'user_id' => $user_id,
            'messages' => Message::orderByDesc('created_at')
        ]);
    }

    public function conversation($userId) {
        $users = User::where('id', '!=', Auth::id())->get();
        $friendInfo = User::findOrFail($userId);
        $myInfo = User::find(Auth::id());
        // $groups = MessageGroup::get();

        $this->data['users'] = $users;
        $this->data['friendInfo'] = $friendInfo;
        $this->data['myInfo'] = $myInfo;
        $this->data['users'] = $users;
        // $this->data['groups'] = $groups;

        return view('message.conversation', $this->data);
    }

    public function sendMessage(Request $request) {
        $request->validate([
           'message' => 'required',
           'receiver_id' => 'required'
        ]);

        $sender_id = Auth::id();
        $receiver_id = $request->receiver_id;

        $message = new Message();
        $message->message = $request->message;

        if ($message->save()) {
            try {
                $message->users()->attach($sender_id, ['receiver_id' => $receiver_id]);
                $sender = User::where('id', '=', $sender_id)->first();

                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['receiver_id'] = $receiver_id;
                $data['content'] = $message->message;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;

                event(new PrivateMessageEvent($data));

                return response()->json([
                   'data' => $data,
                   'success' => true,
                    'message' => 'Message sent successfully'
                ]);
            } catch (\Exception $e) {
                $message->delete();
            }
        }
    }
    
    public function searchUsers(Request $request)
    {

        $user = auth()->user();
        $user_id = auth()->user()->id;

        $query= $request->query;
        dd($request->query);
        $users = DB::table('users')
            ->where('name', $query)
            ->orWhere('surname', $query)
            ->orWhere('email', $query)
            ->limit(10);

    // $users = $q->fetchAll(PDO::FETCH_OBJ);

    if(count($users) > 0){
        foreach($users as $user){
            if ($user->id != auth()->user()->id) {
                ?>
            <div class="display-box-user">
                <a href="?receiver_id=<?= $user->id ?>">
                        <!-- <img src="admin/" alt="Image de profil" class="avatar-xs"> -->

                    <?= e($user->name ." ". $user->surname) ?>

                </a>
            </div>

        <?php
            }
        }
    }
    else{
        echo '<div class="display-box-user">Aucun utilisateur trouvé.</div>';
    }

    }

    public function chat()
    {
        $user = auth()->user();
        $user_id = auth()->user()->id;

        return Inertia::render('Message/Chat', [
            'user' => $user,
            'user_id' => $user_id,
            'messages' => Message::orderByDesc('created_at')
        ]);
    }

    public function getMessages(Request $request)
    {
        $user = auth()->user();
        $user_id = auth()->user()->id;

        $sender_id = $request->sender_id;
        $receiver_id = $request->receiver_id;
        dd($receiver_id);
        $dsn = 'mysql:host=localhost;dbname=digitcmd';
        $username = 'root';
        $password = '';
        $options = [];
        $bdd = new PDO($dsn, $username, $password, $options);

        $chats =  $bdd->query("SELECT * FROM messages WHERE (sender_id = '".$sender_id."' AND toUser = '".$receiver_id."')
        OR (sender_id = '".$receiver_id."' AND receiver_id = '".$sender_id."') ORDER BY created_at ASC");
        $output = "";

        while($chat = $chats){
            if($chat->sender_id == $sender_id)
                $output .= "<div style='text-align:right;'>
                        <p style='background-color:lightblue; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max-width:70%'>
                        ". $chat->content ."
                        </p>
                    </div>";
            else
                $output .= "<div style='text-align:left;'>
                        <p style='background-color:#ececec; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max-width:70%'>
                            ". $chat->content ."
                        </p>
                    </div>";
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasAnyRole(['super_admin', 'admin', 'moderator', 'developer' , 'user'])) {

            $user = auth()->user();

            $user_id = auth()->user()->id;

            if($request->content){

                $sender_id = auth()->user()->id;

                $this->validate($request, [
                    'sender_id' => ['required'],
                    'receiver_id' => ['required'],
                    'content' => ['required', 'min:2', 'max:500'],
                ]);

                // dd($request);

                Message::create([
                    'sender_id' => $sender_id,
                    'receiver_id' => $request->receiver_id,
                    'content' => $request->content,
                ]);

            }

            return Inertia::render('Message/Chat', [
                'user' => $user,
                'user_id' => $user_id,
                'messages' => Message::all()
            ]);
        }

        // event(new ChatMessageEvent(
        //             $request->receiver_id,
        //             $request->content
        //         ));

        // return response()->json([
        //     'success' => 'envoie réussi'
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
