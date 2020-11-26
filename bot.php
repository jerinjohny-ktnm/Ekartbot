<?php
/*
AUTHOR:- RITHUNAND K [BENCHAMXD]

CHANNEL:- @INDUSBOTS

THIS REPO IS LICENSED UNDER GENERAL PUBLIC LICENSE VERSION 3.
*/
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = $_ENV['API_KEY'];
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
//==============BENCHAM======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$username = $update->message->from->username;
$START_MESSAGE = $_ENV['START_MESSAGE'];
//===============BENCHAM=============//
if ($text == "/start") {

            bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$START_MESSAGE

Send your Ekart Tracking ID***",
 'parse_mode'=>'MarkDown',
            
        ]);
 }
if ($text !== "/start"){
$indusdata = json_decode(file_get_contents("https://ekart-api.vercel.app/check?id=$text"),true);
$indusmerchant = $indusdata['merchant_name'];
$indus_status = $indusdata['order_status'];
$indus_tracking = $indusdata['tracking_id'];
$indusupdate1 = implode($indusdata['updates']['0']);
$indusupdate2 = implode($indusdata['updates']['1']);
$indusupdate3 = implode($indusdata['updates']['2']);
$indusupdate4 = implode($indusdata['updates']['3']);
$indusupdate5 = implode($indusdata['updates']['4']);
$indusupdate6 = implode($indusdata['updates']['5']);
$indusupdate7 = implode($indusdata['updates']['6']);
$indusupdate8 = implode($indusdata['updates']['7']);
$indusupdate9 = implode($indusdata['updates']['8']);
$indusupdate10 = implode($indusdata['updates']['10']);
$indusinvalid = $indusdata['msg'];
if($indusdata['time']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"Tʀᴀᴄᴋɪɴɢ ɪᴅ :- $indus_tracking
                
Cᴜʀʀᴇɴᴛ sᴛᴀᴛᴜs:- ***$indus_status***

Mᴇʀᴄʜᴀɴᴛ:- ***$indusmerchant***
               
➤  ʀᴇᴄᴇɴᴛ ᴜᴘᴅᴀᴛᴇs:- 

`$indusupdate10`

`$indusupdate9`

`$indusupdate8`

`$indusupdate7`

`$indusupdate6`

`$indusupdate5`

`$indusupdate4`

`$indusupdate3`

`$indusupdate2`

`$indusupdate1`",
'parse_mode'=>"MarkDown",
                ]);
                }
if($indusdata['msg']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***$indusinvalid***",
                'message_id'=>$message_id,
                'parse_mode'=>"MarkDown",
                
                ]);
                }
                }
 
