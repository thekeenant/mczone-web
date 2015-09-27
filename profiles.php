<?
connect();
$q = mysql_query("SELECT count(*) FROM players");
while ($row = mysql_fetch_array($q)) {
  $playerCount = $row['count(*)'];
}
?>

<div class="page-header">
	<h1>Player Profiles <small>Search <?= $playerCount ?> registered users</small></h1>
</div>


<center>
	<form action="/profiles" method="get" class="form-horizontal">
		Username: <input type="text" name="s" value="<?= $_GET['s'] ?>" class="span2"></input>
		<input type="submit" class="btn btn-primary"></input>
	</form>
<? if ($_GET['s'] != null) { ?>
<? $search = $_GET['s'] ?>

<? if (strlen($_GET['s']) <= 2) { ?>
	Your search must be greater than two characters long!
<? } else { ?>
	<table class="table">
		<thead>
			<th style="width:16px"></th>
			<th>Username</th>
			<th>KD</th>
			<th>Kills</th>
			<th>Deaths</th>
			<th>Games</th>
		</thead>
		<? 
		connect();
		$results = array();
		$query = "SELECT * FROM players WHERE username LIKE '%$search%'";
		$query = str_replace("_", "\_", $query);
		$q = mysql_query($query);
		while ($row = mysql_fetch_array($q)) {
			$u = $row['username'];
			$results[$u] = array();
			$results[$u]['kills'] = mysql_num_rows(mysql_query("SELECT id FROM kills WHERE player='$u'"));
			$results[$u]['deaths'] = mysql_num_rows(mysql_query("SELECT id FROM kills WHERE target='$u'"));
			$games = 0;
			$games += mysql_num_rows(mysql_query("SELECT id FROM skywars_players WHERE username='$u'"));
			$games += mysql_num_rows(mysql_query("SELECT id FROM walls_players WHERE username='$u'"));
			$games += mysql_num_rows(mysql_query("SELECT id FROM hg_players WHERE username='$u'"));
			$results[$u]['games'] = $games;
			$results[$u]['kd'] = round($results[$u]['kills'] / $results[$u]['deaths'], 2);
		}
		uasort($results, function($a, $b) {
    	return $b['kills'] - $a['kills'];
		});

		foreach ($results as $u => $stats) { $c +=1; 
			if ($c > 50) {break;}
			if ($stats['games']==0) {break;};
		?>
		<tr>
			<td><?= avatar($u, 16) ?></td>
			<td><?= user($u) ?></td>
			<td><?= $stats['kd'] ?></td>
			<td><?= $stats['kills'] ?></td>
			<td><?= $stats['deaths'] ?></td>
			<td><?= $stats['games'] ?></td>
		</tr>
		<? } ?>
	</table>



	<? }} ?>
</center>