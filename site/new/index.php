<?php
// returns tsv entries newer than ?utime

$tsv_file = '../gb.tsv';
$utime = $_GET['utime'] ?? 0;

// if no utime supplied, return today's entries
if ($utime == 0) {
	$zone = new DateTimeZone('America/New_York');
	$utime = new DateTime('today', $zone)->getTimestamp();
}
if ($utime < 1777777777 || $utime > 9999999999) {
	die('did not receive unix timestamp');
}

// we can serve as text/tab-separated-values but then it won't just display the damn thing in a browser
header('Content-Type: text/plain; charset=utf8');

if (($gb_file = fopen($tsv_file, "r")) !== false) {
	while (($entry = fgetcsv($gb_file, 5000, "\t", '\\', '')) !== false) {
		$date = $entry[0];
		if ($date > $utime) {
			foreach($entry as $key => $val) {
				print $val;
				if ($key < (count($entry) - 1)) {
					print "\t";
				}
			}
			print "\n";
		}
	}
	fclose($gb_file);
}
exit();
?>
