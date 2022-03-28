<?php

$user = auth()->user();
$user_id = auth()->user()->id;

$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
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