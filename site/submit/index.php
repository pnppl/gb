<?php
// GET endpoint for current status
	// status is always in plaintext
// POST to endpoint to update
	// your ip must be in .my.ip
	// password stored in .passwd must be sent as parameter
	// curl -d "passwd=gay" -d "status=BRRRRRRRRRRRRRRRRRRR%0ABRRRRRRR" http://pnppl.helioho.st/gb/status/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// file locations
	$tsv_file = '../gb.tsv';
	$gif_prefix = '../gif/';
	$bans_file = '.banned.ip';
	$ip_file = '.recent.ip';

	//// ingest form data
	if (strcasecmp($_POST['captcha'] ?? '', 'pnppl') !== 0) {
		die('wrong answer to CAPTCHA');
	}

	$bans_fp = fopen($bans_file, "r") or die("Can't read ban list");
	$bans_str = fread($bans_fp, filesize($bans_file));
	fclose($bans_fp);
	$bans = explode("\n", $bans_str);
	$ip = $_SERVER['REMOTE_ADDR'] ?? '';
	if (in_array($ip, $bans)) {
		die('fuck off');
	}

	$ip_fp = fopen($ip_file, "r") or die("Can't read recents list");
	$ip_str = fread($ip_fp, filesize($ip_file));
	fclose($ip_fp);
	$ip_list = explode("\n", $ip_str);
	// remove timestamps. this will stop working in 260 years
	$ip_list = array_map(fn($str) => substr($str, 11) ?: '', $ip_list);
	if (in_array($ip, $ip_list)) {
		die('someone from your IP has already submitted an entry recently');
	}

	$name = htmlspecialchars($_POST['name'] ?? '') ?: 'anon';
	if (mb_strlen($name, 'UTF-8') > 100) {
		die('name too long');
	}
	if (str_contains($name, 'nigger')) {
		$bans_fp = fopen($bans_file, "a") or die('go fuck yourself!');
		fwrite($bans_fp, $ip . "\n") or die('go fuck yourself!!');
		fclose($bans_fp);
		die('go fuck yourself');
	}

	$url = filter_var($_POST['url'] ?? '', FILTER_VALIDATE_URL) ?: '';
	if (mb_strlen($url, 'UTF-8') > 400) {
		die('URL too long');
	}

	$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL) ?: '';
	if (mb_strlen($email, 'UTF-8') > 100) {
		die('email too long');
	}

	$comment = htmlspecialchars($_POST['comment'] ?? '');
	if (mb_strlen($comment, 'UTF-8') > 4000) {
		die('comment too long');
	}
	if (str_contains($comment, 'nigger')) {
		$bans_fp = fopen($bans_file, "a") or die('fuck you!');
		fwrite($bans_fp, $ip . "\n") or die('fuck you!!');
		fclose($bans_fp);
		die('fuck you');
	}

	$invert = isset($_POST['invert']) ? true : false;

	$art = array_fill(0, 256, false);
	for ($i = 0; $i < 256; $i++) {
		if (isset($_POST['pixel' . $i])) {
			$art[$i] = true;
		}
	}

	if ($name === 'anon' && empty($url) && empty($email) && empty($comment) && !in_array(true, $art, true)) {
		die('please include a name, homepage, URL, email, or art');
	}

	//// do the thing
	$date = time();

	// save art as gif and build string
	$img_str = '';
	if (in_array(true, $art, true)) {
		if ($invert) {
			for ($i = 0; $i < 256; $i++) {
				if ($art[$i]) {
					$art[$i] = false;
				} else {
					$art[$i] = true;
				}
			}
		}

		$gif = imagecreate(16, 16);
		// fill the image with white
		imagecolorallocate($gif, 255, 255, 255);
		$black = imagecolorallocate($gif, 0, 0, 0);

		for ($i = 0, $y = 0; $i < 256; $i++) {
			if ($i % 16 == 0 && $i > 0) {
					$y++;
			}
			if ($art[$i]) {
				imagesetpixel($gif, ($i % 16), $y, $black);
				$img_str .= '1';
			}
			else {
				$img_str .= '0';
			}
		}
		imagegif($gif, $gif_prefix . $date . '.gif');
		imagedestroy($gif);
	}

	// save to tsv
	$name = str_replace(["\t", "\n", "\r"], '', $name);
	$url = str_replace(["\t", "\n", "\r"], '', $url);
	$email = str_replace(["\t", "\n", "\r"], '', $email);
	$comment = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $comment);
	$comment = str_replace("\r\n", '<br>', $comment);
	$comment = str_replace(["\n", "\r"], '<br>', $comment);
	$gb = fopen($tsv_file, 'a');
	// adds annoying unneeded enclosure character
	//fputcsv($gb, [$date, $name, $url, $email, $comment, $img_str], "\t", '\\', '', "\n");
	$line = implode("\t", [$date, $name, $url, $email, $comment, $img_str]);
	fwrite($gb, $line . "\n");
	fclose($gb);

	// update ip list
	$ip_fp = fopen($ip_file, "a");
	fwrite($ip_fp, $date . ' ' . $ip . "\n");
	fclose($ip_fp);

	header('Location: ../#' . $date);
	exit();
}
header('Location: ../');
exit();
?>
