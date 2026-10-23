<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$pics = scandir('.', SCANDIR_SORT_DESCENDING);
	$currDate = substr($pics[2], 0, -8);
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
			padding: 0.25em;
		}
		body,
		img,
		h1 {
			width: fit-content;
			max-width: 100%;
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
		<h1><a href=".."><span style="font-weight:bold; color:hotpink">Hot</span> Pixels</a> IRL</h1>
		<img style="width:800px" src="irl-closeup.jpg" alt="closeup of printer which has been decorated with stickers - a pink party hat and the words HOT PIXELS guestbook" width="800" height="600" title="printer closeup">
		<br>
		<img src="$pics[2]" alt="most recent photo of guestbook's corner of honor: receipt printer and SBC stuck to wall next to window, with USB cords connected and running down wall; receipts with inscrutable text and scrutable pixel art are stuck to wall next to it" width="800" height="1066" title="guestbook corner of honor as of $currDate">
		<h2>cold pixels</h2>
		<ul>
	EOD;
	for ($i = 3; $i < count($pics) - 2; $i++) {
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
