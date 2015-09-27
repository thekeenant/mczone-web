<?
	connect();
	$players = array();

	$q = mysql_query("SELECT * FROM kills WHERE server='skywars'");
	while ($row = mysql_fetch_array($q)) {
	  $players[$row['player']]['kills'] += 1;
	  $players[$row['target']]['deaths'] += 1;
	}

	$q = mysql_query("SELECT username,winner FROM skywars_players");
	while ($row = mysql_fetch_array($q)) {
	  if (count($players[$row['username']])==0)
	    continue;

	  if ($row['winner']==1)
	    $players[$row['username']]['wins'] += 1;

	  $players[$row['username']]['games'] += 1;
	}

	mysql_query("DELETE from skywars_leaderboard");
?>

<? 
	foreach ($players as $username => $stats) {
		$stats['points'] = $stats['wins'] * 10 + $stats['kills'] * 2;
		mysql_query("INSERT INTO skywars_leaderboard (username,wins,kills,deaths,games,points) VALUES ('" . $username . "'," . $stats['wins'] . "," . $stats['kills'] . "," . $stats['deaths'] . "," . $stats['games'] . "," . $stats['points'] . ")"); 
	}
?>

<?
	$players = array();

	$q = mysql_query("SELECT * FROM kills WHERE server='skywars' AND YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE())");
	while ($row = mysql_fetch_array($q)) {
	  $players[$row['player']]['kills'] += 1;
	  $players[$row['target']]['deaths'] += 1;
	}

	$q = mysql_query("SELECT username,winner FROM skywars_players WHERE YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE());");
	while ($row = mysql_fetch_array($q)) {
	  if (count($players[$row['username']])==0)
	    continue;

	  if ($row['winner']==1)
	    $players[$row['username']]['wins'] += 1;

	  $players[$row['username']]['games'] += 1;
	}

	mysql_query("DELETE from skywars_leaderboard_month");
?>

<? 
	foreach ($players as $username => $stats) {
		$stats['points'] = $stats['wins'] * 10 + $stats['kills'] * 2;
		mysql_query("INSERT INTO skywars_leaderboard_month (username,wins,kills,deaths,games,points) VALUES ('" . $username . "'," . $stats['wins'] . "," . $stats['kills'] . "," . $stats['deaths'] . "," . $stats['games'] . "," . $stats['points'] . ")"); 
	}
?>