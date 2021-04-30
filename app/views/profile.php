<?php
$title = "Profile";
$page = 'profile';

$userdata = \Models\Profile_Mod::getUserData();
$data = <<< EOD
<div id='userdata'>$userdata</div>
<br><br>
EOD;