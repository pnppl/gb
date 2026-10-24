<?php
// GET endpoint for current status
	// status is always in plaintext
// POST to endpoint to update
	// your ip must be in .my.ip
	// password stored in .passwd must be sent as parameter
	// curl -d "passwd=gay" -d "status=BRRRRRRRRRRRRRRRRRRR%0ABRRRRRRR" http://gb.pnppl.cc/

// file locations
$tsv_file = '../gb.tsv';
$passwd_file = '.passwd';
$status_file = '.status.txt';
$allowed_file = '.my.ip';

header('Content-Encoding: identity');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	header('Content-Type: text/plain; charset=us-ascii');
	if (($fp = fopen($status_file, "r")) !== false) {
		echo "current status of receipt printer:\n\n";
		if (filesize($status_file) > 0) {
			echo fread($fp, filesize($status_file));
		}
		else {
			echo "unknown error";
		}
		date_default_timezone_set('America/New_York');
		echo "\n\nupdated " . date('Y-m-d @ h:i:sa T', filemtime($status_file));
		fclose($fp);
	}
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (($fp = fopen($allowed_file, "r")) === false) {
		die("couldn't read allow file");
	}
	$allowed = fread($fp, filesize($allowed_file));
	$allowed = substr($allowed, 0, -1); // newline
	fclose($fp);

	if (($fp = fopen($passwd_file, "r")) === false) {
		die("couldn't read password file");
	}
	$passwd = fread($fp, filesize($passwd_file));
	$passwd = substr($passwd, 0, -1);
	fclose($fp);

	$ip = $_SERVER['REMOTE_ADDR'] ?? '';
	if (strcmp($ip, $allowed) !== 0) {
		die("not allowed");
	}
	if (strcmp($_POST['passwd'] ?? '', $passwd) !== 0) {
		die("wrong password");
	}

	$status = $_POST['status'] ?? '';
	if (!isset($status)) {
		die("no status provided");
	}
	if (($fp = fopen($status_file, "w")) === false) {
		die("couldn't write status");
	}
	fwrite($fp, $status);
	fclose($fp);

	echo "updated status to: $status";
}
exit();
?>
