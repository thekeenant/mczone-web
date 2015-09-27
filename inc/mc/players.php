<?



if ($server == null)
	$server = $_GET['server'];
if ($port == null)
	$port = $_GET['port'];
if ($port == null)
	$port = 25565;

if ($min == null)
	$min = $_GET['min'];
if ($max == null)
	$max = $_GET['max'];

$count = 0;

if ($server == "walls") {
	$server = "198.100.97.107";
	$min = 4001;
	$max = 4050;
	$port = 0;
}

if ($server == "hg") {
	$server = "198.100.101.219";
	$min = 4601;
	$max = 4630;
	$port = 0;
}

if ($server == "skywars") {
	$server = "198.100.101.219";
	$min = 4101;
	$max = 4125;
	$port = 0;
}

if ($server == "sg") {
	$server = "198.100.115.186";
	$min = 4201;
	$max = 4250;
	$port = 0;
}

if ($server == "nexus") {
	$server = "64.237.39.226";
	$min = 13001;
	$max = 13010;
	$port = 0;
}

if ($server == "ghost") {
	$server = "ghost";
	$min = 1801;
	$max = 1810;
	$v2 = true;
	$port = 0;
}

if ($server == "lobby") {
	$server = "lobby";
	$min = 51;
	$max = 61;
	$v2 = true;
	$port = 0;
}

if ($server == "nebula") {
	$server = "198.27.75.226";
	$min = 4501;
	$max = 4510;
	$port = 0;
}

if ($v2 == true) {
	$port = $min;
	while ($port <= $max) {
		$string = query("localhost", 850, "get/" . $server . ":" . $port);
		if (strstr($string, ",")) {
			$arr = explode(",", $string);
			$count += $arr[1];
		}
		$port += 1;
	}
}
else if ($server == null || $server == "total") {
	$port = 2600;
	$count += countProxy("198.24.166.251", 2600,"count");
	$count += countProxy("198.24.166.252", 2600,"count");
	$count += countProxy("198.24.165.66", 2600,"count");
	$count += countProxy("198.24.165.67", 2600,"count");
	$count += countProxy("198.24.165.68", 2600,"count");
	
	if ($count < 450) {
		$count += round($count / 3);
	}
}
else if ($port == 25565) {
	$s = getStatus($server, 25565);
	$count += $s->online_players;
}
else if ($min != null && max != null) {
	$port = $min;
	while ($port <= $max) {
		$string = query($server, $port, "status");
		if (strstr($string, "|")) {
			$arr = explode("|", $string);
			$count += $arr[1];
		}
		$port += 1;
	}
}
else {
	$string = query($server, $port, "status");
	if (strstr($string, "|")) {
		$arr = explode("|", $string);
		$count += $arr[1];
	}
}

echo $count;




?>