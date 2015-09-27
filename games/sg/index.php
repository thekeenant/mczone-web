<? $title = "Survival Games"; connect() ?>

<header class="subhead">
  <div class="container">
    <h1>The Survival Games</h1>
    <p class="lead">
      Fight in various maps that are filled with chests, puzzles and traps, with the best items
      in the center of the map. Start in the center with 23 other players, and fight to the death.
    </p>
    <a class="btn btn-primary btn-large" data-toggle="modal" href="#play" >Play Now »</a>
  </div>
</header>
<hr />
<h3>Recent Games <small>The last 50 games played on our servers</small></h3>
<div class="row">
  <div class="span12">
    <table class="table">
      <thead>
        <th>ID</th>
        <th>Winner</th>
        <th>Players</th>
        <th>Start</th>
        <th>End</th>
        <th>Duration</th>
      </thead>
      <?
        $q = mysql_query("SELECT * FROM sg_games WHERE winner IS NOT null AND winner != 'none' ORDER BY start DESC limit 15");
        while ($row = mysql_fetch_array($q)) {
          $info = $row;
          if ($info['winner'] == null)
            $info['winner']="NONE";
          $info['duration'] = timediff($info['start'],$info['end']);
          if ($info['duration'] > 500000) {
            $info['duration'] = duration($info['start']);
            $info['end'] = "";
          }
          else {
            $info['end'] = datetime($info['end']);
          }

          $info['kills'] = mysql_num_rows(mysql_query("SELECT * FROM kills WHERE server='hg' AND game_id=" . $row['id']));
          $info['players'] = mysql_num_rows(mysql_query("SELECT * FROM hg_players WHERE game_id=" . $row['id']));
      ?>

      <tr>
        <td><a href="id/<?= $row['id'] ?>"><?= $info['id'] ?></a></td>
        <td><?= avatar($info['winner'],16) . ' ' . user($info['winner']) ?></td>
        <td><?= $info['players'] ?></td>
        <td><?= datetime($info['start']) ?></td>
        <td><?= $info['end'] ?></td>
        <td><?= $info['duration'] ?></td>
      </tr>
      <? } ?>
    </table>
  </div>
</div>