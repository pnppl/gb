<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$pics = scandir('.', SCANDIR_SORT_DESCENDING);
	$currDate = substr($pics[1], 0, -8);
	echo <<<EOD
	<!DOCTYPE html>
	<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="color-scheme" content="light dark">
		<link rel="icon" href="../favicon.ico">
		<title>Hot Pixels IRL | pnppl.cc</title>
		<style><!--
		body {
			background: #eee;
			font-family: "Victor Mono", monospace;
		}
		img {
		}
		body,
		img,
		h1 {
			width: fit-content;
			height: auto;
			margin: auto;
		}
		@media (prefers-color-scheme: dark) {
			body {
				background: black;
			}
		}
		--></style>
	</head>
	<body>
		<h1>Hot Pixels IRL</h1>
		<img src="$pics[1]" alt="most recent photo of the guestbook's corner of honor" width="800" height="1066" title="guestbook corner of honor as of $currDate">
		<h2>old pixels</h2>
		<ul>
	EOD;
	for ($i = 2; $i < count($pics) - 2; $i++) {
		echo "<li><a href=\"$pics[$i]\">$pics[$i]</a></li>";
	}
	echo <<<EOD
		</ul>
		<p>taken with Sony Mavica FD-87</p>
	</body>
	</html>
	EOD;
}
exit();
?>
