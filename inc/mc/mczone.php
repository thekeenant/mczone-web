<?
$HOST = $_GET['server'];
$PORT = $_GET['port'] + 3000;

if ($HOST=="walls") {
  foreach (walls() as $s) {
	  $arr = explode(":", $s);
	  $first = $arr[1];
	  $port = intval($first) + 3000;
	  echo $first . " is " . mczone('198.100.97.107', $port, $_GET['cmd']) . "<br />";
  }
}
else if ($HOST=="skywars") {
  foreach (skywars() as $s) {
	  $arr = explode(":", $s);
	  $first = $arr[1];
	  $port = intval($first) + 3000;
	  echo $first . " is " . mczone('198.100.101.219', $port, $_GET['cmd']) . "<br />";
  }
}
else if ($HOST=="hg") {
  foreach (hg() as $s) {
	  $arr = explode(":", $s);
	  $first = $arr[1];
	  $port = intval($first) + 3000;
	  echo $first . " is " . mczone('198.100.101.219', $port, $_GET['cmd']) . "<br />";
  }
}
else {
	echo mczone($HOST, $PORT, $_GET['cmd']);
}


function mczone($HOST, $PORT, $text) {

	$sock = socket_create(AF_INET, SOCK_STREAM, 0); //Creating a TCP socket

	$succ = socket_connect($sock, $HOST, $PORT); //Connecting to to server using that socket

	socket_write($sock, $text . "\n", strlen($text) + 1); //Writing the text to the socket;

	socket_set_timeout($sock, 1);
	
	$reply = socket_read($sock, 10000, PHP_NORMAL_READ); //Reading the reply from socket;

	if ($reply == null) {
		return 'ERROR';
	}
	return $reply;

}

?>