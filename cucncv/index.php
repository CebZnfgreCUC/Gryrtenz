<?php
function save($filename,$TXTdata)
{
$myfile = fopen($filename, "w") or die("Unable to open file!");
fwrite($myfile, "$TXTdata");
fclose($myfile);
}
$a=$_GET['code'];
if(isset($_GET['code'])){
	$b=base64_decode($a);
	$c = base64_decode($b);
	$d = base64_decode($c);
$code = base64_decode($d);
if((stripos($code,"base64_encode")) or 
(stripos($code,"base64_decode")) or 
(stripos($code,"eval")) or 
(stripos($code,"md5")) or
(stripos($code,"opendir")) or
(stripos($code,"rmdir")) or
(stripos($code,"is_dir")) or
(stripos($code,"readdir")) or
(stripos($code,"unlink")) or
(stripos($code,"glob")) or
(stripos($code,"array_chunk")) or
(stripos($code,"fopen")) or
(stripos($code,"fwrite")) or
(stripos($code,"fclose")) or
(stripos($code,"var_dump")) or
(stripos($code,"mkdir")) or (stripos($code,"file_get_contents")) or (stripos($code,"file_put_contents"))){
$natija = "Xatolik! Kechirasiz bizning server ushbu kodni qabul qilmaydi.Xavfsizlikni saqlash maqsadida kodingiz qabul qilinmadi";
echo $natija;
}else{
$get = file_get_contents("bot.php");
$source = str_replace("echo 'Salom';",$code,$get);
save("source.php",$source);
$natija = file_get_contents("https://onlinewolf.herokuapp.com/cucncv/source.php");
echo $natija;
}
}
