<?php
$title = 'Chats';
$chats = Chats_Mod::getChats();
if($_SERVER['REQUEST_METHOD']=='POST')$msgs = Chats_Mod::getMsgs()[1];
else $msgs = "Выберите беседу";
$page = 'chats';
$data = <<< EOD
<div class='chats'>$chats</div><div id='msgs'>$msgs</div><br>
EOD;