<?php
$title = "Profile";
$userdata = Profile_Mod::getUserData();
$html = <<< EOD
$userdata<br>
<br><input type='button' value='Выйти' onclick=logout()>
EOD;