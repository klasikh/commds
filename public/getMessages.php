<?php

// $user = auth()->user();
// $user_id = auth()->user()->id;

// extract($_POST);

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];

$dsn = 'mysql:host=localhost;dbname=digitcmd';
$username = 'root';
$password = '';
$options = [];
$bdd = new PDO($dsn, $username, $password, $options);

$chats =  $bdd->query("SELECT * FROM messages WHERE (sender_id = '".$sender_id."' AND receiver_id = '".$receiver_id."')
OR (sender_id = '".$receiver_id."' AND receiver_id = '".$sender_id."') ORDER BY created_at ASC");
$output = "";

while($chat = $chats->fetch(PDO::FETCH_OBJ)){
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

echo $output;