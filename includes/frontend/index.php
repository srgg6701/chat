<?php
$content = ob_get_contents();
ob_end_clean(); ?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Multiwidget Dev Home</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="/includes/frontend/js/jquery.min.js"></script>
	<link rel="stylesheet" href="/includes/frontend/css/screen.css"/>
</head>
<body>
<header>
	<nav>
		<?php require_once "menu.php"; ?>
	</nav>
</header>
<div id="container">
	<div id="main">
		<main>
			<div class="container">
				<div>
					<?php echo $content; ?>
				</div>
			</div>
		</main>
	</div>
	<hr/>
	<footer>
			<div id="footer">Footer</div>
	</footer>
</div>
</body>
</html>