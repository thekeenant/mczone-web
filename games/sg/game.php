<?
    connect();
    $q = mysql_query("SELECT * FROM sg_games WHERE id=" . $_GET['id']);
    while ($row = mysql_fetch_array($q)) {
      $info = $row;
      if ($info['winner'] == null)
        $info['winner']="NONE";
      $info['duration'] = timediff($info['start'],$info['end']);
      if ($info['duration'] > 500000)
        $info['duration'] = duration($info['start']);

    }

    $players = array();
    $q = mysql_query("SELECT * FROM sg_players WHERE game_id=" . $_GET['id']);
    while ($row = mysql_fetch_array($q)) {
      $arr = array();
      $arr['kit'] = $row['kit'];
      if ($row['winer'] == 1)
        $arr['winner'] = '&#x2713;';
      $players[$row['username']] = $arr;
    }

    $kills = array();
    $q = mysql_query("SELECT * FROM kills WHERE server='sg' AND game_id=" . $_GET['id'] . " ORDER BY date DESC");
    while ($row = mysql_fetch_array($q)) {
      $kill = array();
      $kill['player'] = $row['player'];
      $kill['target'] = $row['target'];
      $kills[$row['date']] = $kill;

      $arr = $players[$row['player']];
      $arr['kills'] += 1;
      if (count($arr['kills_string'])==0)
        $arr['kills_string'] = array();
      array_push($arr['kills_string'],user($row['target']));
      if ($row['player'] != 'quit' && $row['player'] != 'natural')
        $players[$row['player']] = $arr;

      $arr = $players[$row['target']];
      $arr['killer'] = $row['player'];
      $arr['death'] = strtotime($row['date']) - strtotime($info['start']);
      $arr['duration'] = timediff($info['start'], $row['date']);

      if ($arr['death'] > 0)
        $players[$row['target']] = $arr;
    }
    $players[$info['winner']]['death'] = strtotime($info['end']) - strtotime($info['start']) + 1;

    uasort($players, function($a, $b) {
      return ($b['death'] < $a['death']) ? -1 : 1;
    });
  ?>


<? include '../shared/header.php'; ?>


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
          <td><?= avatar($info['winner'],16) ?> <?= user($info['winner']) ?></td>
        </tr>
        <tr>
          <th>Participants</th>
          <td><?= count($players) ?></td>
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


  <h3>Players <small>Particpants of this match (<b><?= count($players) ?></b>)</small></h3><hr />
  <table class="table">
    <thead>
      <th></th>
      <th>Username</th>
      <th>Kit</th>
      <th style="width:40%;">Kills</th>
      <th>Killer</th>
      <th style="width: 12%;">Death</th>
    </thead>
    <? foreach ($players as $username => $p) { ?>
      <tr>
        <td><?= avatar($username, 16) ?></td>
        <td><?= user($username) ?></td>
        <td><?= ucwords($p['kit']) ?></td>
        <td><?= $p['kills'] ?> <? if ($p['kills'] > 0) { ?>(<?= implode(', ',$p['kills_string']) ?>)<? } ?></td>
        <td><?
          if ($p['killer']=="quit" || $p['killer']=="natural")
            echo '<i>' . ucwords($p['killer']) . '</i>';
          else
            echo user($p['killer']) 
        ?></td>
        <td><?= $p['duration'] ?></td>
    <? } ?>
  </table>


<script>
$(document).ready(function() {
   $('.sort-time').dataTable( {
      "bPaginate": false,
      "bLengthChange": false,
      "bFilter": false,
      "bInfo": false,
      "aaSorting": [[ 5, "desc" ]]
   });
} );

</script>