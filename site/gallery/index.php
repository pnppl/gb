<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$pics = scandir('../gif/', SCANDIR_SORT_ASCENDING);
	echo <<<EOD
	<!DOCTYPE html>
	<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="color-scheme" content="light dark">
		<link rel="icon" href="../favicon.ico">
		<title>Hot Pixels Gallery | pnppl.cc</title>
		<style><!--
		img {
			display: inline;
			image-rendering: crisp-edges;
			image-rendering: pixelated;
		}
		#size1:checked ~ p img {
			width: 16px;
			height: 16px;
		}
		#size2:checked ~ p img {
			width: 32px;
			height: 32px;
		}
		#size4:checked ~ p img {
			width: 64px;
			height: 64px;
		}
		#size8:checked ~ p img {
			width: 128px;
			height: 128px;
		}
		#size8:checked ~ p img {
			width: 256px;
			height: 256px;
		}
		#size16:checked ~ p img {
			width: 512px;
			height: 512px;
		}
		body,
		h1,
		p {
			width: fit-content;
			max-width: 100%;
			margin: auto;
			text-align: center;
			font-family: "Victor Mono", monospace;
			padding: 0.25em;
		}
		body {
			background: #eee;
		}
		.space {
			display: none;
		}
		#space:checked ~ p .space {
			display: inline;
		}
		#border:checked ~ p img {
			border: 2px solid hotpink;
			border-color: hotpink #aa4678 #aa4678 hotpink;
		}
		#invert:checked ~ p img {
			filter: invert();
			border-color: #00964b #55b987 #55b987 #00964b;
		}
		input,
		label {
			user-select: none;
			cursor: pointer;
		}
		@media (prefers-color-scheme: dark) {
			body {
				background: black;
			}
		}
		--></style>
	</head>
	<body>
		<h1><a href=".."><span style="font-weight:bold; color:hotpink">Hot</span> Pixels</a> Gallery</h1>
		<span style="display:none">Options (requires CSS): </span><!--
		--><input type="radio" id="size1" value="1" name="size"><label for="size1">1&#215; </label><!--
		--><input type="radio" id="size2" value="2" name="size" checked><label for="size2">2&#215; </label><!--
		--><input type="radio" id="size4" value="4" name="size"><label for="size4">4&#215; </label><!--
		--><input type="radio" id="size8" value="8" name="size"><label for="size8">8&#215; </label><!--
		--><input type="radio" id="size16" value="16" name="size"><label for="size16">16&#215; </label><!--
		--><input type="checkbox" id="space" value="space" name="space" checked><label for="space">Space out </label><!--
		--><input type="checkbox" id="border" value="border" name="border"><label for="border">Border </label><!--
		--><input type="checkbox" id="invert" value="invert" name="invert"><label for="invert">Invert</label>
		<p>

	EOD;
	for ($i = 2; $i < count($pics); $i++) {
		echo "<a href=\"../gif/$pics[$i]\"><img src=\"../gif/$pics[$i]\" width=\"16\" height=\"16\" title=\"$pics[$i]\"></a><span class=\"space\">\n\t\t</span>";
	}
	echo <<<EOD

		</p>
	</body>
	</html>
	EOD;
}
exit();
?>
