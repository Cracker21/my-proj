<?php
$title = 'Chats';
$chats = Chats_Mod::getChats();
$page = 'chats';
$data = <<< EOD
$chats<br>
EOD;