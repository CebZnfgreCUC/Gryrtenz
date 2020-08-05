<?php
if(isset($_GET['token'])){
$a = $_GET['token'];
$b = $_GET['url'];
$c = file_get_contents("http://api.telegram.org/bot".$a."/deleteWebhook");
if($c){
file_get_contents("http://api.telegram.org/bot".$a."/setwebhook?url=".$b);
}
}
?>
