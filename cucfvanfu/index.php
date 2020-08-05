<?php
define('API_KEY','946272065:AAE0Baznwn8pZESiF_vtWy2TTWA9gZeieqA');
function ty($ch){
return bot('sendChatAction', [
'chat_id' => $ch,
'action' => 'typing',
]);
}

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

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$cid = $message->chat->id;
$cidtyp = $message->chat->type;
$miid = $message->message_id;
$name = $message->chat->first_name;
$user1 = $message->from->username;
$text = $message->text;
$callback = $update->callback_query;
$mmid = $callback->inline_message_id;
$mes = $callback->message;
$mid = $mes->message_id;
$cmtx = $mes->text;
$mmid = $callback->inline_message_id;
$idd = $callback->message->chat->id;
$cbid = $callback->from->id;
$cbuser = $callback->from->username;
$data = $callback->data;
$ida = $callback->id;
$cqid = $update->callback_query->id;
$cbins = $callback->chat_instance;
$cbchtyp = $callback->message->chat->type;
$step = file_get_contents("step/$cid.step");
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$msgs = json_decode(file_get_contents('msgs.json'),true);
$data = $update->callback_query->data;
$type = $message->chat->type;
$text = $message->text;
$cid = $message->chat->id;
$uid= $message->from->id;
$gname = $message->chat->title;
$left = $message->left_chat_member;
$new = $message->new_chat_member;
$name = $message->from->first_name;
$bio = $messenge->from->about;
$repid = $message->reply_to_message->from->id;
$repname = $message->reply_to_message->from->first_name;
$newid = $message->new_chat_member->id;
$leftid = $message->left_chat_member->id;
$newname = $message->new_chat_member->first_name;
$leftname = $message->left_chat_member->first_name;
$username = $message->from->username;
$cmid = $update->callback_query->message->message_id;
$cusername = $message->chat->username;
$repmid = $message->reply_to_message->message_id; 
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;

$photo = $message->photo;
$gif = $message->animation;
$video = $message->video;
$music = $message->audio;
$voice = $message->voice;
$sticker = $message->sticker;
$document = $message->document;
$for = $message->forward_from;
$forc = $message->forward_from_chat;
$data = $update->callback_query->data;

$time=date("H:i",strtotime("2 hour"));
$kun=date("d-m-Y",strtotime("2 hour"));
/*
$kid = 'SoftIcon'; $kkid = '@SoftIcon'; 
if(isset($update->message->text)){
$gett = bot('getChatMember',[
'chat_id' =>$kkid,
'user_id' => $update->message->chat->id,
]);
$gget = $gett->result->status;
if($gget == "member" or $gget == "creator" or $gget == "administrator"){
}else{
bot('sendMessage',
[ 'chat_id'=>$update->message->chat->id,
'message_id'=>$update->message->message_id,
'parse_mode'=>'html',
'text'=>"Hurmatli foydalanuvchi botnin shaxsiy kanaliga a'zo bo'lsangizgina botdan foydalana olasiz.Botning shaxsiy kanali @SoftIcon",
'reply_markup'=>json_encode([  'inline_keyboard'=>[
    [['text'=>"A'zo bo'lish 🎗",'url'=>'http://t.me/'.$kid.'']],
] 
]) 
]);
return true;
}   
}
*/
if($text){
	ty($cid);
}
$reply_menu = json_encode([
           'resize_keyboard'=>false,
            'force_reply' => true,
            'selective' => true
        ]);
    $repsu = $message->reply_to_message->text;
$gg = file_get_contents("php.txt");
if($text == "/start"){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"Assalomu alaykum hurmatli foydalanuvchi.Kodingizni yuboring.(Text formatida $gg larsiz)"
]);
}
if($text and $text !="/start"){
$a = base64_encode($text);
$b = base64_encode($a);
$c = base64_encode($b);
$d = base64_encode($c);
$nat = file_get_contents("http://promaster.xvest.ru/Decoder/php_sinash_api.php?code=".$d);
if($nat == null){
$natija="Xatolik.Menimcha nimanidir unutib qoldirdingiz.";
}else{
$natija = $nat;
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"Natija: $natija"
]);
}
?>
