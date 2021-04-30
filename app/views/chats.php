<?php
use Models\Chats_Mod;

$title = 'Chats';
$page = 'chats';

$chats = Chats_Mod::getChats();
if($_SERVER['REQUEST_METHOD']=='POST')$msgs = Chats_Mod::getMsgs()[1];
else $msgs = "Выберите беседу";
$data = <<< EOD
<div class='chats'>$chats</div><div id='msgs'>$msgs</div><div class='sendMsg'><input id='msgInp'><input type='button' value='Отправить' onclick='sendMsg()'></div><br>
EOD;