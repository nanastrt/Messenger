<?php
#define
define('API_KEY','TOKEN'); //توکن
//=======================================================//
#function
function bot($method,$datas=[]){
    $url = 'https://api.telegram.org/bot'.API_KEY.'/'.$method;
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
//=======================================================//
#variables
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$text = $update->message->text;
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$message_id = $update->message->message_id;
$username = $update->callback_query->from->username;
$username2 = $update->message->from->username;
$data = $update->callback_query->data;
$chatid = $update->callback_query->message->chat->id;
$messageid = $update->callback_query->message->message_id;
$forward_username = $update->message->forward_from_chat->username;
$NCS = $update->message->reply_to_message->forward_from->id;
mkdir("data/$chat_id");
$command = file_get_contents("data/$chat_id/command.txt");
$mnmf = file_get_contents("data/$chat_id/Mehdi.txt");
$ban = file_get_contents("data/ban.txt");
$first_name = $update->message->from->first_name;
$first = $update->callback_query->from->first_name;
$last_name = $update->callback_query->from->last_name;
$admin = "484616919"; //ادمین
$host = "Lord_Support";
//=======================================================//
#functions
function SendMessage($chat_id,$text,$keyboard){
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'reply_markup'=>$keyboard]);
}
function edit($chat_id,$meesage_id,$text,$reply_markup){
	bot('editMessageText',[
	'chat_id'=>$chat_id,
	'message_id'=>$message_id,
	'text'=>$text,
	'reply_markup'=>$reply_markup]);
}
function save($filename, $data)
{
$file = fopen($filename, 'w');
fwrite($file, $data);
fclose($file);
}
function ForwardMessage($chatid,$from_chat,$message_id){
	bot('ForwardMessage',[
	'chat_id'=>$chatid,
	'from_chat_id'=>$from_chat,
	'message_id'=>$message_id]);
}
if(strpos($ban,"$chat_id") !== false && $chat_id != $admin){
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما کاربر عزیز توسط ادمین از ربات بلاک شدید."]);
	return false;
}
elseif(strpos($ban,"$chat_id") !== false && $chatid != $admin){
	bot('SendMessage',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"شما کاربر عزیز توسط ادمین از ربات بلاک شدید."]);
	return false;
}
//=======================================================//
#start
if($text == "/start"){
		$user = file_get_contents('Member.txt');
	$members = explode("\n",$user);
	if(!in_array($chat_id,$members)){
		$add_user = file_get_contents('Member.txt');
		$add_user .= $chat_id."\n";
		file_put_contents('Member.txt',$add_user);
	}
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام  کاربر گرامی  🤠

به ربات پیام رسان من خوش امدید 💛

با این ربات علی رغم ارسال پیام به من  میتوانید اطلاعاتی نظیر اطلاعات شخصی من و اطلاعات تیم و هاستینگ
را بدست اورید ❣️


✳️لطفا پیام خود را ارسال کنید:",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"🔖اطلاعات من️",'callback_data'=>"me"],['text'=>"📋 اطلاعات تیم",'callback_data'=>"info"]],
	[['text'=>"🔗 هاستینگ ما",'callback_data'=>"host"]],
	],'resize_keyboard'=>true])
	]);
}
//=======================================================//
#me
elseif($data == "me"){
	bot('editMessageText',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"Mehdi Yousefi 🙍🏻‍♂️

#php ❣️

Ch: @Nic_Source

id:
@MrNimble",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"🔙بازگشت",'callback_data'=>"back"]],
	],'resize_keyboard'=>true])
	]);
}
//=======================================================//
#info
elseif($data == "info"){
	bot('editMessageText',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"اعضای تیم :

👤 مدیر تیم:
.....

👥 اعضای تیم:
.....

🏷سابقه فعالیت:
....

📍 تماس با ما:
.....",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"🔙بازگشت",'callback_data'=>"back"]],
	],'resize_keyboard'=>true])
	]);
}
//=======================================================//
#back
elseif($data == "back"){
	bot('editMessageText',[
	'chat_id'=>$chat_id,
	'text'=>"سلام  کاربر گرامی $from_fname 🤠

به ربات پیام رسان من خوش امدید 💛

با این ربات علی رغم ارسال پیام به من  میتوانید اطلاعاتی نظیر اطلاعات شخصی من و اطلاعات تیم و هاستینگ
را بدست اورید ❣️


✳️لطفا پیام خود را ارسال کنید:",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"🔖اطلاعات من️",'callback_data'=>"me"],['text'=>"📋 اطلاعات تیم",'callback_data'=>"info"]],
	[['text'=>"🔗 هاستینگ ما",'callback_data'=>"host"]],
	],'resize_keyboard'=>true])
	]);
}
//=======================================================//
#pv
elseif($NCS != "" && $from_id == $admin){
bot('sendMessage',[
'chat_id'=>$chat_id,
 'text'=>$text,
'parse_mode'=>'MarkDown',
]);
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"پیام شما با موفقیت به کاربر ارسال شد ✅",
'parse_mode'=>'MarkDown',
 ]);
 }
else {
bot("forwardmessage",[
 'chat_id'=>$admin,
  'from_chat_id'=>$chat_id,
  'message_id'=>$message_id,
 ]);
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"پیام شما با موفقیت به ادمین ارسال شد✅
❣️ منتظر پاسخ باشید!",
'parse_mode'=>'MarkDown',
 ]);
}
//=======================================================//
#hosting
if($data == "host"){
	bot('editMessageText',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"#فروش_ویژه💯

🌟فروش #هاست #سی_پنل با قابلیت پشتیبانی از #میدلاین⚡️

🇳🇱موقعیت سرور: هلند🇳🇱

🚀پر سرعت و دارای گواهی Ssl #رایگان🚀

✨قیمت مناسب و ارزان✨

🔰از حجم ۵۱۲ مگابایت تا 20 گیگ موجود است✅

💳خرید سرویس های لورد میزبان:
LordMizban.ir/cart.php

👤مشاوره قبل از خرید:
 @Lord_Support

لورد میزبان، میزبانی متفاوت😄👇
🌐 LordMizban.ir",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"🚨خرید هاست🚨",'url'=>"https://t.me/$host"]],
	],'resize_keyboard'=>true])
	]);
}
//=======================================================//
#panel
elseif($text == "/panel" and $from_id == $admin){
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام مدیر گرامی 🤠

به پنل مدیریت ربات خوش اومدی 😬

چه کاری می تونم برات انجام بدم؟؟؟؟؟؟؟؟",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"📮 امار کاربران",'callback_data'=>"amar"]],
	[['text'=>"🔹انبن کردن کاربر🔹",'callback_data'=>"unlo"],['text'=>"🔺بن کاربر🔺",'callback_data'=>"blo"]],
	[['text'=>"▪️لیست بن▪️",'callback_data'=>"listt"]],
	],'resize_keyboard'=>true])
	]);
}
//=======================================================//
#stats
elseif($data == "amar" and $chatid == $admin){
	$user = file_get_contents('Member.txt');
	$member = explode("\n",$user);
	$Mehdi = count($member)-1;
	bot('editMessageText',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"📍 امار ربات شما تاکنون :
	$Mehdi",
	'pars_mode'=>'html',
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"▫️panel▫️",'callback_data'=>"panel"]],
],'resize_keyboard'=>true])
]);
}
//=======================================================//
#ban
elseif($data == "blo" and $chatid == $admin){
	save("data/$chatid/command.txt","ban");
	bot('editMessageText',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"آیدی عددی کاربری که میخواهید بلاک کنید را بفرستید تا بلاکش کنم.",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"▫️panel▫️",'callback_data'=>"panel"]],
	],'resize_keyboard'=>true])
	]);
}
elseif($command == 'ban'){
	save("data/$chat_id/command.txt","none");
	$myfile2 = fopen("data/ban.txt","a") or die("Unable to open file!");
	fwrite($myfile2,"$text\n");
	fclose($myfile2);
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"کاربر مورد نظر با موفقیت بلاک شد.",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"▫️panel▫️",'callback_data'=>"panel"]],
	],'resize_keyboard'=>true])
	]);
	bot('SendMessage',[
	'chat_id'=>$text,
	'text'=>"شما کاربر عزیز توسط ادمین بلاک شدید"]);
}
//=======================================================//
#unban
elseif($data == "unlo" and $chatid == $admin){
	save("data/$chatid/command.txt","unban");
	bot('editMessageText',[
	'chat_id'=>$chatid,
	'message_id'=>$messageid,
	'text'=>"آیدی عددی کاربری که میخواهید آنبلاکش کنید رو بفرستید تا آنبلاکش کنم.",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"▫️panel▫️",'callback_data'=>"panel"]],
	],'resize_keyboard'=>true])
	]);
}
elseif($command == 'unban'){
	save("data/$chat_id/command.txt","none");
	$newlist = str_replace($text,"",$ban);
	save("data/ban.txt",$newlist);
	bot('SendMessage',[
	'chat_id'=>$chat_id,
	'text'=>"کاربر مورد نظر با موفقیت آنبلاک شد.",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"▫️panel▫️",'callback_data'=>"panel"]],
	],'resize_keyboard'=>true])
	]);
	bot('SendMessage',[
	'chat_id'=>$text,
	'text'=>"شما کاربر عزیز توسط ادمین با موفقیت از بلاک خارج شدید."]);
}
//=======================================================//
#listban
elseif($data == "listt" and $chatid == $admin){
		$ban = file_get_contents("data/ban.txt");
			bot('editMessageText',[
			'chat_id'=>$chatid,
			'message_id'=>$messageid,
			'text'=>"آیدی عددی کاربران بلاک شده:
			
			$ban",
			'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"▫️panel▫️",'callback_data'=>"panel"]],
	],'resize_keyboard'=>true])
	]);
}
//=======================================================//
#panel
if($data == "panel" and $chatid == $admin){
	bot('editMessageText',[
	'chat_id'=>$chat_id,
	'text'=>"سلام مدیر گرامی 🤠

به پنل مدیریت ربات خوش اومدی 😬

چه کاری می تونم برات انجام بدم؟؟؟؟؟؟؟؟",
	'pars_mode'=>'html',
	'reply_markup'=>json_encode(['inline_keyboard'=>[
	[['text'=>"📮 امار کاربران",'callback_data'=>"amar"]],
	[['text'=>"🔹انبن کردن کاربر🔹",'callback_data'=>"unlo"],['text'=>"🔺بن کاربر🔺",'callback_data'=>"blo"]],
	[['text'=>"▪️لیست بن▪️",'callback_data'=>"listt"]],
	],'resize_keyboard'=>true])
	]);
}
?>