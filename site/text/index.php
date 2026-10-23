<?php
// we basically want to serve utf8 to anything remotely modern
$utf8 = false;
if (strripos($_SERVER['HTTP_ACCEPT'] ?? '', 'utf') !== false ||
	strripos($_SERVER['HTTP_ACCEPT_CHARSET'] ?? '', 'utf') !== false ||
	strripos($_SERVER['HTTP_ACCEPT_ENCODING'] ?? '', 'gzip') !== false ||
	strripos($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '', 'en') !== false ||
	strripos($_SERVER['HTTP_USER_AGENT'] ?? '', 'curl') !== false) {
	$utf8 = true;
}
// params override headers
if (array_key_exists('utf8', $_GET)) {
	$utf8_param = $_GET['utf8'] ?? '';
	if (strripos($utf8_param, 'y') !== false || strripos($utf8_param, 't') !== false) {
		$utf8 = true;
	}
	if (strripos($utf8_param, 'n') !== false || strripos($utf8_param, 'f') !== false) {
		$utf8 = false;
	}
	if (empty($utf8_param)) {
		$utf8 = true;
	}
}

$plain = false;
if (strripos($_SERVER['HTTP_USER_AGENT'] ?? '', 'curl') !== false) {
	$plain = true;
}
if (array_key_exists('plain', $_GET)) {
	$plain_param = $_GET['plain'] ?? '';
	if (strripos($plain_param, 'y') !== false || strripos($plain_param, 't') !== false) {
		$plain = true;
	}
	if (strripos($plain_param, 'n') !== false || strripos($plain_param, 'f') !== false) {
		$plain = false;
	}
	if (empty($plain_param)) {
		$plain = true;
	}
}

// host says it's brotli compressed otherwise and firefox is unhappy
header('Content-Encoding: identity');
$header = 'Content-Type: text/';
if ($plain) {
	$header .= 'plain; charset=';
}
else {
	$header .= 'html; charset=';
}
if ($utf8) {
	$header .= 'utf-8';
}
else {
	$header .= 'us-ascii';
}
header($header);

$pic = $_GET['pic'] ?? '';
// return random if no pic supplied
if (empty($pic)) {
	$gb_path = "../gb.tsv";
	$gb_file = fopen($gb_path, "r") or die("No pic supplied and can't read guestbook tsv");
	$gb_str = fread($gb_file, filesize($gb_path)) or die("No pic supplied and can't read guestbook tsv");;
	fclose($gb_file);
	$gb_entries = explode("\n", rtrim($gb_str));
	$gb_entry = $gb_entries[array_rand($gb_entries)];
	$pic = end(explode("\t", $gb_entry));
}
if (strlen($pic) !== 256) {
	die("invalid image");
}

$html = <<<'EOD'
<!DOCTYPE html>
<!--
parameters:
	pic: 256 0s and 1s representing pixels in 16x16 grid
	utf8: use nice utf8 characters to draw the image, otherwise ascii
	plain: serve only the text of the image, otherwise html
	plain and utf8:
		enable: blank, any string with a Y or T (case insens.)
		disable: any string with an N or F (case insens.)
		if omitted, will attempt to select best option based on HTTP headers
-->
<html>
<head>
	<link rel="icon" href="../favicon.ico">
	<title>Text art</title>
	<style><!--
	code {
		font-family: "Victor Mono Medium", monospace;
	}
	#pic {
		display: block;
		width: 18em;
		width: fit-content;
		border: 1px solid hotpink;
		background: white;
	}
	#pic br,
	.border {
		display: none;
	}
	.black {
		color: black;
		background: black;
	}
	.white {
		color: white;
		background: white;
	}
	.black,
	.white {
		display: inline-block;
		width: 1.1em;
		height: 1.1em;
	}
	.row {
		display: block;
		width: 100%;
		height: 1.1em;
		overflow: hidden;
	}
	@media (prefers-color-scheme: dark) {
		body {
			background: black;
		}
	}
	--></style>
<body>
	<div id="pic">
		<code class="border">
EOD;
if ($utf8) {
	$html .= '&#9484;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9488;';
}
else {
	$html .= '+--------------------------------+';
}
$html .= <<<EOD
</code>
		<br>

EOD;
$text_plain = "+--------------------------------+\n";
$text_utf8 = "┌────────────────────────────────┐\n";

//foreach ($_SERVER as $key => $value) {
//    if (strpos($key, 'HTTP_') === 0) {
//        echo $key . ': ' . $value . "\n";
//    }
//}

for ($i = 0, $y = 0; $i < 256; $i++) {
	if ($i % 16 == 0) {
		$html .= <<<'EOD'
		<code class="row"><span class="border">
EOD;
		if ($utf8) {
			$html .= '&#9474;';
		}
		else {
			$html .= "|";
		}
		$html .= "</span>";
		$text_plain .= '|';
		$text_utf8 .= '│';
		if ($i > 0) {
			$y++;
		}
	}
	if ($pic[$i]) {
		// full block unicode char
		if ($utf8) {
			$html .= '<span class="black">&#9608;&#9608;</span>';
		}
		// hash
		else {
			$html .= '<span class="black">&#35;&#35;</span>';
		}
		$text_plain .= "##";
		$text_utf8 .= "██";
	}
	else {
		$html .= '<span class="white">&nbsp;&nbsp;</span>';
		$text_plain .= "  ";
		$text_utf8 .= "  ";
	}
	if (($i + 1) % 16 == 0) {
		if ($utf8) {
			$html .= '<span class="border">&#9474;</span></code><br>';
		}
		else {
			$html .= '<span class="border">|</span></code><br>';
		}
		$html .= "\n";
		$text_plain .= "|\n";
		$text_utf8 .= "│\n";
	}
}
$html .= <<<'EOD'
		<code class="border">
EOD;
if ($utf8) {
	$html .= '&#9492;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9496;';
}
else {
	$html .= '+--------------------------------+';
}
$html .= <<<'EOD'
</code>
		<br>
	</div>
	<input id="copy" type="button" onclick="pic = document.getElementById('pic').innerText; navigator.clipboard.writeText(pic); document.getElementById('copy').value = 'copied';" value="copy">
</body>
</html>
EOD;

$text_plain .= "+--------------------------------+\n";
$text_utf8 .= "└────────────────────────────────┘\n";

if ($plain) {
	if ($utf8) {
		print $text_utf8;
	}
	else {
		print $text_plain;
	}
}
else {
	print $html;
}
exit();
?>
