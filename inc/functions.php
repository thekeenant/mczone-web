<?
session_start();
$username = $_COOKIE['username'];
$root = $_SERVER['DOCUMENT_ROOT'];
ini_set('memory_limit', '-1');
error_reporting(E_ERROR);
/*
error_reporting(E_ALL);
ini_set('display_errors', '1');
*/

function limit_text($string,$length=100,$appendStr="..."){
    $truncated_str = "";
    $useAppendStr = (strlen($string) > intval($length))? true:false;
    $truncated_str = substr($string,0,$length);
    $truncated_str .= ($useAppendStr)? $appendStr:"";
    return $truncated_str;
}

function players($server) {
	ob_start();
	include "mc/players.php";
	$content = ob_get_clean();  
	return $content;
}


function getStatus($server) {
  	include_once 'mc/status/Stats.php';
  	include_once 'mc/status/Server.php';
	$stats = \status\Stats::retrieve(new \status\Server($server));
	return $stats;
}
function loggedIn() {
	if ($_COOKIE['username'] != "")
		return true;
	else
		return false;
}

function adminCategories() {
	return array("Official News");
}

function avatar($username,$size=64) {
	if ($size <= 64)
		$class = "avatar";
	return '<div style="padding:2px;display:inline;width:' . $size . 'px;height:' . $size . 'px;" class="avatar-case"><img class="'. $class . '" src="/inc/mc/avatar.php?s=' . $size . '&u=' . $username . '" /></div>';
}

function user($u) {
	$sub = getPosition($u);
	connect();
	$q = mysql_query("SELECT username,subscription FROM players WHERE username='$u'");
	$result = null;
	while ($row = mysql_fetch_array($q)) {
		$subs = $row['subscription'];
		$u = $row['username'];
		if ($subs != null)
			$sub = $subs;
	}
	if ($sub=="admin") {
		$bold = "bold";
		$color = "#DE0000";
	}
	if ($sub=="mod")
		$color = "#DE0000";
	if ($sub=="vip")
		$color = "#E89600";
	if ($sub=="elite")
		$color = "green";
	if ($sub=="titan")
		$color = "blue";

	return '<a style="font-weight: ' . $bold . ';color: ' . $color . ';" href="/user/' . $u . '">' . $u . '</a>';
}

function color($u) {
	$sub = strtolower($u);
	if ($sub=="admin") {
		$bold = "bold";
		$color = "#DE0000";
	}
	if ($sub=="mod")
		$color = "#DE0000";
	if ($sub=="vip")
		$color = "#E89600";
	if ($sub=="elite")
		$color = "green";
	if ($sub=="titan")
		$color = "blue";

	if ($color != null)
		return '<span style="font-weight: ' . $bold . ';color: ' . $color . ';" href="/user/' . $u . '">' . $u . '</span>';

	$sub = getPosition($u);
	if ($sub=="admin") {
		$bold = "bold";
		$color = "#DE0000";
	}
	if ($sub=="mod")
		$color = "#DE0000";
	if ($sub=="vip")
		$color = "#E89600";
	if ($sub=="elite")
		$color = "green";
	if ($sub=="titan")
		$color = "blue";

	return '<span style="font-weight: ' . $bold . ';color: ' . $color . ';" href="/user/' . $u . '">' . $u . '</span>';
}

function getPosition($u) {
	connect();
	$q = mysql_query("SELECT subscription FROM players WHERE username='$u'");
	$result = null;
	while ($row = mysql_fetch_array($q)) {
		$sub = $row['subscription'];
		if ($sub != null)
			$result = $sub;
	}
	return $result;
}

function redirect($url) {
	header('Location: ' . $url);
}

function flashNotice($msg) {
	$_SESSION['notice'] = $msg;
}

function flashError($msg) {
	$_SESSION['error'] = $msg;
}

function ajax($file) {
	$prepend = '<div class="ajax" id="ajax-' . $file . '"><br />';
	$content = '<center>' . img('loader.gif') . '</center>';
	$append = '<br /></div>';
	return $prepend . $content . $append;
}

function img($file) {
	if (strstr($file, "http")) {
		return '<img src="' . $file . '"/>';
	}
	return '<img src="/assets/img/' . $file . '"/>';
}

function render($partial) {
	require 'partial/' . $partial . '.php';
}

function connect($database = "mczone") {
	$con = mysql_connect("localhost","root","nice try mr. pro hacker");
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	$selected = mysql_select_db($database,$con) 
	or die('<div class="well"><b>Error: </b>Could not select database</div>');
}

function strtime($str, $detailed = false) {
	if ($detailed)
		return strftime('%b %e, %Y at %I:%M %p', strtotime($str));
	else
		return strftime('%b %e, %Y', strtotime($str));
}

function cacheHeader($file, $cachetime = 300) {
	$cachefile = "cache/" . $file;
echo file_exists($cachefile);
	if (file_exists($cachefile) && (time() - $cachetime < filemtime($cachefile))) {
		echo "<!-- Cached ".date('jS F Y H:i', filemtime($cachefile))." -->";
		echo(file_get_contents($cachefile));
		return true;
	}
	ob_start();
	return false;
}  

function cacheFooter($file) {
	$fp = fopen("cache/" . $file, 'w'); 
	fwrite($fp, ob_get_contents());

	fclose($fp); 
	ob_end_flush();
}

function timeago($date,$granularity=1) {
	connect();
	$q = mysql_query("SELECT now()");

	while ($row = mysql_fetch_array($q)) {
		$now = strtotime($row['now()']);
	}
	$date = strtotime($date);
	$difference = $now - $date;
	$periods = array('decade' => 315360000,
		'year' => 31536000,
		'month' => 2628000,
		'week' => 604800, 
		'day' => 86400,
		'hour' => 3600,
		'minute' => 60,
		'second' => 1);
    if ($difference <= 0) { // less than 5 seconds ago, let's say "just now"
    $retval = "just now";
    return $retval;
} else {                            
	foreach ($periods as $key => $value) {
		if ($difference >= $value) {
			$time = floor($difference/$value);
			$difference %= $value;
			$retval .= ($retval ? ' ' : '').$time.' ';
			$retval .= (($time > 1) ? $key.'s' : $key);
			$granularity--;
		}
		if ($granularity == '0') { break; }
	}
	return $retval.' ago';      
}
}

function datetime($str, $simple = false) {
	if (!$simple)
		return strftime('%b %e, %Y at %I:%M %p', strtotime($str));
	else
		return strftime('%b %e, %Y', strtotime($str));
}

function timediff($s, $e){

	/* Find out the seconds between each dates */
	$timestamp = strtotime($e) - strtotime($s);

	/* Cleaver Maths! */
	$years=floor($timestamp/(60*60*24*365));$timestamp%=60*60*24*365;
	$weeks=floor($timestamp/(60*60*24*7));$timestamp%=60*60*24*7;
	$days=floor($timestamp/(60*60*24));$timestamp%=60*60*24;
	$hrs=floor($timestamp/(60*60));$timestamp%=60*60;
	$mins=floor($timestamp/60);$secs=$timestamp%60;
	$sec=floor($timestamp);$secs=$timestamp;

	/* Display for date, can be modified more to take the S off */
	if ($years > 1) { $str.= $years.' years'; }
	if ($weeks > 1) { $str.= $weeks.' weeks'; }
	if ($days > 1) { $str.=$days.' days'; }
	if ($hrs > 1) { $str.=$hrs.' hours'; }
	if ($mins > 1) { $str.=$mins.' minutes'; }
	if ($mins < 1 && $sec > 1) { $str.=$sec.' seconds'; }

	if ($years == 1) { $str.= $years.' year'; }
	if ($weeks == 1) { $str.= $weeks.' week'; }
	if ($days == 1) { $str.=$days.' day'; }
	if ($hrs == 1) { $str.=$hrs.' hour'; }
	if ($mins == 1) { $str.=$mins.' minute'; }
	if ($sec == 1) { $str.=$sec.' second'; }

	return $str;
}


function query($HOST = "localhost", $PORT = "25565", $text = "status") {
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


function duration($seconds, $max_periods = 2) {
    $periods = array('year' => 31536000, 'month' => 2419200, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);
    $i = 1;
    foreach ( $periods as $period => $period_seconds ) {
        $period_duration = floor($seconds / $period_seconds);
        $seconds = $seconds % $period_seconds;
        if ( $period_duration == 0 ) continue;
        $duration[] = $period_duration .' '. $period . ($period_duration > 1 ? 's' : '');
        $i++;
        if ( $i > $max_periods ) break;
    }
    if (is_null($duration)) return 'just now';
    return implode(' ', $duration);
}

function skywars() {
	$arr = array();
	$i = 1;
	while ($i <= 40) {
		$arr[$i] = '198.100.101.219:' . (1100+$i);
		$i++;
	}
	return $arr;
}

function hg() {
	$arr = array();
	$i = 1;
	while ($i <= 40) {
		$arr[$i] = '198.100.101.219:' . (1600+$i);
		$i++;
	}
	return $arr;
}

function walls() {
	$arr = array();
	$i = 1;
	while ($i <= 80) {
		$arr[$i] = 'gamma.mczone.co:' . (1000 + $i);
		$i++;
	}
	return $arr;
}

function hg_kits() {
	connect();
	$kits = array();
	$kitsquery = mysql_query("SELECT * FROM hg_packages ORDER BY title");
	while ($row = mysql_fetch_array($kitsquery)) {
		array_push($kits,$row['title']);
	}
	return $kits;
}

function walls_kits() {
	connect();
	$kits = array();
	$kitsquery = mysql_query("SELECT * FROM walls_packages ORDER BY title");
	while ($row = mysql_fetch_array($kitsquery)) {
		array_push($kits,$row['title']);
	}
	return $kits;
}

function skywars_kits() {
	connect();
	$kits = array();
	$kitsquery = mysql_query("SELECT * FROM skywars_packages ORDER BY title");
	while ($row = mysql_fetch_array($kitsquery)) {
		array_push($kits,$row['title']);
	}
	return $kits;
}


function countProxy($HOST, $PORT, $text) {

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
