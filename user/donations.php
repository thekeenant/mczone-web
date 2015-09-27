<div class="page-header">
	<h1>Donations <small>Does not display your subscriptions</small></h1>
</div>
<?
  connect();

  $donations = array();
  $q = mysql_query("SELECT * FROM walls_donations WHERE username='$username' AND free=0");
  while ($row = mysql_fetch_array($q)) {
  	$d = array();
  	$d['server'] = "The Walls";
  	$d['id'] = $row['id'];
  	$d['date'] = $row['date'];
  	$d['amount'] = "2.50";
  	$d['benefit'] = $row['kit'] . ' kit';
  	array_push($donations, $d);
  }
  $q = mysql_query("SELECT * FROM hg_donations WHERE username='$username' AND free=0");
  while ($row = mysql_fetch_array($q)) {
  	$d = array();
  	$d['server'] = "Hunger Games";
  	$d['id'] = $row['id'];
  	$d['date'] = $row['date'];
  	$d['amount'] = "2.50";
  	$d['benefit'] = $row['kit'] . ' kit';
  	array_push($donations, $d);
  }
  $q = mysql_query("SELECT * FROM skywars_donations WHERE username='$username' AND free=0");
  while ($row = mysql_fetch_array($q)) {
  	$d = array();
  	$d['server'] = "Sky Wars";
  	$d['id'] = $row['id'];
  	$d['date'] = $row['date'];
  	$d['amount'] = "2.50";
  	$d['benefit'] = $row['kit'] . ' kit';
  	array_push($donations, $d);
  }

  uasort($donations, function($a, $b) {
    return (strtotime($b['date']) < strtotime($a['date'])) ? -1 : 1;
  });
?>

<table class="table table-no-sort">
  <thead>
    <th>ID</th>
    <th>Game</th>
    <th>Benefit</th>
    <th>Amount</th>
  </thead>

  <? foreach ($donations as $d) { ?>
  <tr>
    <td><?= $d['id'] ?></td>
    <td><?= $d['server'] ?></td>
    <td><?= datetime($d['date']) ?></td>
    <td><?= ucwords($d['benefit']) ?></td>
  </tr>
  <? } ?>
</table>