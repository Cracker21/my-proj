<!DOCTYPE html>
<html lang="ru">
<head>
	<title><?php echo $title; ?></title>
	<meta name='viewport' content="width=device-width, initial-scale=1">
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="icon" type="image/png" href="icon.png" />
	<link rel="manifest" href="manifest.json" />
	<script src="script.js"></script>
	<script src="ws.js"></script>
</head>
<body>
	<div id="container" class="<?php echo $page ?>">
	<?php
		
		echo $html;
	?>
	<input id='sid' type='hidden' value=<?php echo session_id() ?>>
	<div id='debug'><?php echo @$_SESSION['name'] ?></div>
	</div>
</body>
</html>