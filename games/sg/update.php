<?
connect();
$players = array();

$q = mysql_query("SELECT * FROM kills WHERE server='sg'");
while ($row = mysql_fetch_array($q)) {
  $players[$row['player']]['kills'] += 1;
  $players[$row['target']]['deaths'] += 1;
}

$q = mysql_query("SELECT username FROM sg_players");
while ($row = mysql_fetch_array($q)) {
  if (count($players[$row['username']])==0)
    continue;


  $players[$row['username']]['games'] += 1;
}

$q = mysql_query("SELECT winner FROM sg_games");
while ($row = mysql_fetch_array($q)) {
   
  $players[$row['winner']]['wins'] += 1;
}

mysql_query("DELETE from sg_leaderboard");


foreach ($players as $username => $stats) {
	$stats['points'] = $stats['wins'] * 10 + $stats['kills'];
	mysql_query("INSERT INTO sg_leaderboard (username,wins,kills,deaths,games,points) VALUES ('" . $username . "'," . $stats['wins'] . "," . $stats['kills'] . "," . $stats['deaths'] . "," . $stats['games'] . "," . $stats['points'] . ")");
} 

$players = array();

$q = mysql_query("SELECT * FROM kills WHERE server='sg' AND YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE())");
while ($row = mysql_fetch_array($q)) {
  $players[$row['player']]['kills'] += 1;
  $players[$row['target']]['deaths'] += 1;
}

$q = mysql_query("SELECT username FROM sg_players WHERE YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE())");
while ($row = mysql_fetch_array($q)) {
  if (count($players[$row['username']])==0)
    continue;


  $players[$row['username']]['games'] += 1;
}

$q = mysql_query("SELECT winner FROM sg_games WHERE YEAR(start) = YEAR(CURDATE()) AND MONTH(start) = MONTH(CURDATE())");
while ($row = mysql_fetch_array($q)) {
   
  $players[$row['winner']]['wins'] += 1;
}

mysql_query("DELETE from sg_leaderboard_month");
$r = 0;

foreach ($players as $username => $stats) {
	$stats['points'] = $stats['wins'] * 10 + $stats['kills'];
	mysql_query("INSERT INTO sg_leaderboard_month (username,wins,kills,deaths,games,points) VALUES ('" . $username . "'," . $stats['wins'] . "," . $stats['kills'] . "," . $stats['deaths'] . "," . $stats['games'] . "," . $stats['points'] . ")");
} 
?>