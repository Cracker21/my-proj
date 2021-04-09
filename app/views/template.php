<!DOCTYPE html>
<html lang="ru">
<head>
	<title><?php echo $title; ?></title>
	<meta name='viewport' content="width=device-width, initial-scale=1">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="icon.png" />
	<link rel="manifest" href="manifest.json" />
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<?php
		echo "<div id='container' class='$page'>";
		echo "$menu<br>$data<br>";
		echo "</div>";
	?>
</body>
</html>