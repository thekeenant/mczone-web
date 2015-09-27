<?
    connect();
    $q = mysql_query("SELECT * FROM nexus_games WHERE id=" . $_GET['id']);
    while ($row = mysql_fetch_array($q)) {
      $info = $row;
      if ($info['winner'] == null)
        $info['winner']="NONE";
      $info['duration'] = timediff($info['start'],$info['end']);
      if ($info['duration'] > 500000)
        $info['duration'] = duration($info['start']);
    }

    $players = array();
    $q = mysql_query("SELECT * FROM nexus_players WHERE game_id=" . $_GET['id']);
    while ($row = mysql_fetch_array($q)) {
      if ($row['team']=="red")
        array_push($red, $row['username']);
      else if ($row['team']=="green")
        array_push($green, $row['username']);
      else if ($row['team']=="blue")
        array_push($blue, $row['username']);
      else if ($row['team']=="yellow")
        array_push($yellow, $row['username']);

      $arr = array();
      $arr['team'] = $row['team'];
      $arr['kit'] = $row['kit'];
      if ($row['winer'] == 1)
        $arr['winner'] = '&#x2713;';
      $players[$row['username']] = $arr;
    }

    $kills = array();
    $q = mysql_query("SELECT * FROM kills WHERE server='nexus' AND game_id=" . $_GET['id'] . " ORDER BY date DESC");
    while ($row = mysql_fetch_array($q)) {
      $kill = array();
      $kill['player'] = $row['player'];
      $kill['target'] = $row['target'];
      $kills[$row['date']] = $kill;

      $arr = $players[$row['player']];
      $arr['kills'] += 1;
      if (count($arr['kills_string'])==0)
        $arr['kills_string'] = array();
      array_push($arr['kills_string'],$row['target']);
      if ($row['player'] != "left" && $row['player'] != "natural")
      $players[$row['player']] = $arr;

      $arr = $players[$row['target']];
      $arr['killer'] = $row['player'];
      $players[$row['target']] = $arr;
    }
  ?>



<div class="page-header">
 <h2>Session <small>You are viewing the game with ID <b><?= $info['id'] ?></b></small></h2>
</div>

<div class="row-fluid">
<div class="span5">
  <table class="table">
    <tr>
      <th>Game ID</th>
      <td><?= $info['id'] ?></td>
    </tr>
    <tr>
      <th>Winner</th>
      <td><span class="label label-<?= $info['winner'] ?>"><?= strtoupper($info['winner']) ?></span></td>
    </tr>
    <tr>
      <th>Participants</th>
      <td><?= count($players) ?></td>
    </tr>
    <tr>
      <th>Kills</th>
      <td><?= count($kills) ?></td>
    </tr>
    <tr>
      <th>Start Time</th>
      <td><?= datetime($info['start'], false) ?></td>
    </tr>
    <tr>
      <th>End Time</th>
      <td>
        <? if (strtotime($info['end']) >= strtotime($info['start'])) { echo datetime($info['end'], false); } ?>
        <? if (strtotime($info['end']) < strtotime($info['start'])) { echo 'In Progress'; } ?>
      </td>
    </tr>
    <tr>
      <th>Duration</th>
      <td><?= $info['duration'] ?></td>
    </tr>
  </table>
</div>
</div>


<div class="page-header page-header-mini">
 <h3>Players <small>Particpants of this match (<b><?= count($players) ?></b>)</small></h3>
</div>

<table class="table table-no-page">
<thead>
  <th class="avatar-column"></th>
  <th>Username</th>
  <th>Team</th>
  <th>Kit</th>
  <th>Kills</th>
  <th>Killer</th>
  <th>Alive</th>
</thead>
<? foreach ($players as $username => $p) { ?>
  <?
    $q = mysql_query("SELECT * FROM kills WHERE server='nexus' AND target='" . $username . "' AND game_id=" . $_GET['id']);
    $alive = mysql_num_rows($q) == 0 ? "&#x2713;" : false;
  ?>
  <tr>
    <td><?= avatar($username,16) ?></td>
    <td><a href="/user/<?= $username ?>"><?= $username ?></a></td>
    <td><span class="label label-<?= $p['team'] ?>"><?= strtoupper($p['team']) ?></span></td>
    <td><?= ucwords($p['kit']) ?></td>
    <td class="sorting_1"><?= $p['kills'] ?></td>
    <td><?
      if ($p['killer']=="left" || $p['killer']=="natural")
        echo '<i>' . ucwords($p['killer']) . '</i>';
      else
        echo user($p['killer']) 
    ?></td>
    <td><?= $alive ?></td>
  </tr>
<? } ?>
</table>

<div class="row-fluid">
    <div class="span6">
  <div class="page-header page-header-mini">
     <h4>Kills <small>PVP encounters during this game (<b><?= count($kills) ?></b>)</small></h4>
  </div>
  <? $i = 0 ?>
  <? foreach ($kills as $time => $kill) { ?>
    <? $p = $kill['player']; $t = $kill['target'] ?>
    <p>
      <?= avatar($t,16) ?> <b><?= user($t) ?></b>  
      <? if ($p=="natural") { echo 'was killed by <b>natural causes</b></p>'; continue;} ?>
      <? if ($p=="left") { echo '<b>left the game</b></p>'; continue;} ?>
      was killed by
      <?= avatar($p,16) ?> <b><?= user($p) ?></b>
    </p>
  <? } ?>
</div>
</div>