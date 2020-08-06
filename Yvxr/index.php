<?php
$admin = '503177249';
$admin2 = "1070846128";
$token = '908572028:AAHrg4Y5QEv_F8MBySLBpgofINWAbfYh4c4';
define('API_KEY',$token);
function bot($method,$datas=[]){
global $token;
    $url = "https://api.telegram.org/bot".$token."/".$method;
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
$mid = $message->message_id;
$msgs = json_decode(file_get_contents('msgs.json'),true);

$type = $message->chat->type;
$text = $message->text;
$cid = $message->chat->id;
$uid= $message->from->id;
$gname = $message->chat->title;
$left = $message->left_chat_member;
$new = $message->new_chat_member;
$name = $message->from->first_name;
$repid = $message->reply_to_message->from->id;
$repname = $message->reply_to_message->from->first_name;
$newid = $message->new_chat_member->id;
$leftid = $message->left_chat_member->id;
$newname = $message->new_chat_member->first_name;
$leftname = $message->left_chat_member->first_name;
$username = $message->from->username;
$cusername = $message->chat->username;
$repmid = $message->reply_to_message->message_id; 

$data = $update->callback_query->data;
$cmid = $update->callback_query->message->message_id;
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$qid = $update->callback_query->id; 

$ctext = $update->callback_query->message->text; 
$callfrid = $update->callback_query->from->id; 
$callfname = $update->callback_query->from->first_name;  
$calltitle = $update->callback_query->message->chat->title; 
$calluser = $update->callback_query->message->chat->username; 
 
$channel = $update->channel_post; 
$channel_text = $channel->text;
$channel_mid = $channel->message_id; 
$channel_id = $channel->chat->id; 
$channel_user = $channel->chat->username; 
$channel_name = $channel->chat->title; 
//@PHP_New eng zo’r php kodlar bizning kanalda
$chanel_doc = $channel->document; 
$chanel_vid = $channel->video; 
$chanel_mus = $channel->audio; 
$chanel_voi = $channel->voice; 
$chanel_gif = $channel->animation; 
$chanel_fot = $channel->photo; 
$caption=$channel->caption;
$cap=file_get_contents("baza/$channel_id.txt");
$id_photo = $message->photo;
mkdir("like");
mkdir("baza");
mkdir("pechat");

if($text=="/start"){
  bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"Salom <b>$name</b>, bu bot kanallardagi postlaringizga ulashish va like tugmalarini qo'yib beradi. Buning uchun botni kanalingizga qo'shib administratorlik huquqlarini berib qo'yishingiz kerak!.

Ajoyib funksiya: Kanalga tashlangan har bir rasmga avtomatik kanal logosini qo'yib beradi.

<code>#off</code> - rasmga logo qo'yish funksiyasini o'chirish
<code>#on</code> - rasmga logo qo'yish funksiyasini yoqish
<code>#comment</code> va so'z - Har bir postingizga #comment so'zidan keyingi yozgan so'zingiz qo'shiladi
<code>#text</code> - #comment ga yozlilgan matningiz
<code>#clear</code> - #comment matnini o'chirib yuborish

<b>Yuqorida keltirilgan buyruqlar faqat kanallarda ishlaydi!</b>",
   'parse_mode' => 'html'
  ]);
}
$pechatmode = file_get_contents("pechat/$channel_id.txt");
if(isset($chanel_doc) or isset($chanel_vid) or isset($chanel_mus) or isset($chanel_voi) or (isset($channel->photo) and $pechatmode == "off") or isset($chanel_gif) or isset($channel_text)){
   bot('editmessagecaption',[
        'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'caption'=>"$caption

$cap",
        'parse_mode'=>'html',
      ]);
  
    $tokenn=uniqid("true");

    bot('editMessageReplyMarkup',[
        'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'inline_query_id'=>$qid, 
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"👍", 'callback_data'=>"$tokenn=👍"],['text'=>"👎",'callback_data'=>"$tokenn=👎"]],
       [['text'=>"Do'stlarga ulashish", "url"=>"https://telegram.me/share/url?url=https://telegram.me/$channel_user/$channel_mid"]], 
       ] 
       ]) 
       ]);
}

if(isset($channel->photo) and $pechatmode == "on"){
$photo = $channel->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('photo.jpeg', file_get_contents('https://api.telegram.org/file/bot'.API_KEY.'/'.$patch));
$login = "@$channel_user";
$stamp = imagecreatefrompng('stamp.png');
$im = imagecreatefromjpeg('photo.jpeg');
$font = imageloadfont('font.gdf');

$white = imagecolorallocate($stamp, 1255, 765, 765);

$font_path = 'arial.ttf';



imagettftext($stamp, 25, 0, 18, 46, $white, $font_path, $login);

$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp);
$sy = imagesy($stamp);


imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 75);

imagepng($im, 'photo_stamp.png');
imagedestroy($im);

  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
  $tokenn=uniqid("true");
bot('sendPhoto',[
'chat_id'=>$channel_id,
'caption'=>"$caption

$cap",
'parse_mode'=>'html',
'photo'=>new CURLFile('photo_stamp.png'),
'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"👍", 'callback_data'=>"$tokenn=👍"],['text'=>"👎",'callback_data'=>"$tokenn=👎"]],
       [['text'=>"Do'stlarga ulashish", "url"=>"https://telegram.me/share/url?url=https://telegram.me/$channel_user/$channel_mid"]], 
       ] 
       ])
]);
}
if(mb_stripos($data,"=")!==false){ 
$ex=explode("=",$data); 
$calltok=$ex[0]; 
$emoj=$ex[1]; 
$mylike=file_get_contents("like/$calltok.dat"); 
if(mb_stripos($mylike,"$callfrid")!==false){ 
      bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"Kechirasiz siz ovoz berib bo'lgansiz!", 
        'show_alert'=>false, 
    ]); 
}else{ 
file_put_contents("like/$calltok.dat","$mylike\n$callfrid=$emoj"); 
$value=file_get_contents("like/$calltok.dat"); 
$lik=substr_count($value,"👍"); 
$des=substr_count($value,"👎"); 
     bot('editMessageReplyMarkup',[ 
        'chat_id'=>$ccid, 
        'message_id'=>$cmid,
        'inline_query_id'=>$qid,
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"👍 $lik", 'callback_data'=>"$calltok=👍"],['text'=>"👎 $des",'callback_data'=>"$calltok=👎"]], 
       [['text'=>"Do'stlarga ulashish", "url"=>"https://telegram.me/share/url?url=https://telegram.me/$channel_user/$channel_mid"]], 
       ] 
       ]) 
       ]);
       bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"Ovozingiz qabul qilindi!", 
        'show_alert'=>false, 
    ]);  
  }
}

if(mb_stripos($channel_text,"#comment")!==false){
  $ex=explode("#comment", $channel_text);
  $exe=$ex[1];
  file_put_contents("baza/$channel_id.txt", "$exe");
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
}

if($channel_text=="#text"){
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
  bot('sendmessage',[
    'chat_id'=>$channel_id,
    'text'=>$cap,
    'parse_mode'=>'html',
  ]);
}
//@PHP_New eng zo’r php kodlar bizning kanalda
if($channel_text=="#clear"){
  unlink("baza/$channel_id.txt");
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
}
if($channel_text=="#off"){
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid
  ]);
  file_put_contents("pechat/$channel_id.txt", "off");
}elseif($channel_text=="#on"){
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid
  ]);
  file_put_contents("pechat/$channel_id.txt", "on");
}

$gruppa = file_get_contents("channel.dat");
$lichka = file_get_contents("azolar.dat");
if($channel_text or $chanel_fot or $chanel_gif or $chanel_voi or $chanel_mus or $chanel_doc){
if(strpos($gruppa,"$channel_id") !==false){
}else{
file_put_contents("channel.dat","$gruppa\n$channel_id");
}
}
if($type=='private'){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("azolar.dat","$lichka\n$cid");
}
} 
$reply = $message->reply_to_message->text;
$rpl = json_encode([
            'resize_keyboard'=>false,
            'force_reply'=>true,
            'selective'=>true
        ]);
$yubbi = "Yuboriladigan xabar matnini kiriting!";
if($text=="/send" and ($cid==$admin or $cid==$admin2)){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>$yubbi,
    'parse_mode'=>"html",
    'reply_markup'=>$rpl
]);
}
if($reply == $yubbi){
  $lich = file_get_contents("azolar.dat");
  $lichka = explode("\n",$lich);
  foreach($lichka as $lichkalar){
  $okuser=bot("sendmessage",[
    'chat_id'=>$lichkalar,
    'text'=>$text,
    'parse_mode'=>'html'
]);
}
if($okuser){
  bot("sendmessage",[
    'chat_id'=>$cid,
    'text'=>"Hamma userlarga yuborildi!",
    'parse_mode'=>'html',
]);
}
}
$dead = "Kanallarga yuboriladigan xabar matnini kiriting!";
if($text=="/sendchannel" and ($cid==$admin or $cid==$admin2)){
  bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>$dead,
    'parse_mode'=>"html",
    'reply_markup'=>$rpl
  ]);
}
if($reply == $dead){
  $gr = file_get_contents("channel.dat");
  $grup = explode("\n",$gr);
foreach($grup as $chatlar){
  $okguruh=bot("sendmessage",[
    'chat_id'=>$chatlar,
    'text'=>$text,
    'parse_mode'=>'html',
]);
}
if($okguruh){
  bot("sendmessage",[
    'chat_id'=>$cid,
    'text'=>"Hamma kanallarga yuborildi!",
    'parse_mode'=>'html',
]);
}
}
if($text=="/stat"){
  $lich = substr_count($lichka,"\n");
  $gr = substr_count($gruppa,"\n");
  $jami = $lich + $gr;
  bot('sendmessage',[
    'chat_id'=>$cid,
    'reply_to_message_id'=>$mid,
    'text'=>"<b>Bot foydalanuvchilari soni:</b>

A'zolar: <b>$lich</b> ta
Kanallar: <b>$gr</b> ta
Xammasi bo'lib: <b>$jami</b> ta",
    'parse_mode'=>"html"
  ]);
}
?>
