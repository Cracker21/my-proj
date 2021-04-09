<?php
$title = "Profile";
$page = 'profile';

$userdata = Profile_Mod::getUserData();
$data = <<< EOD
<div id='userdata'>$userdata</div>
<br><br>
EOD;