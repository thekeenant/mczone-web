<div class="page-header">
  <h1>Vote for MC Zone</h1>
</div>

<p>
  <b>Top voters this month get a free one month subscription! </b>1st place gets Titan, 2nd place gets Elite, and 3rd gets
  VIP! Ties go to the player with the most time online! In addition to this, you also get a free kit on HG, Walls, and Sky Wars!
</p><hr />

<div class="alert alert-notice">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Notice: </strong> Voting is now narrowed to one page. Vote using the button below to get a free kit on Hunger Games, The Walls, and Sky Wars!
</div>

<center>
  <a target="_new" href="http://minecraftservers.org/vote/38340" class="btn btn-large btn-primary">Vote</a>
</center>
<hr />
<center>
  <h3>Top Voters</h3><br />
  <table style="width: 300px" class="table table-striped table-bordered">
    <tr>
      <th>#</th>
      <th>Username</th>
      <th>Votes</th>
    </tr>
    <?
      $i = 0;
      connect();
      $arr = array();
      $query = mysql_query("SELECT * FROM votes WHERE username != 'anonymous' AND month(now())=month(date)");
      while ($row = mysql_fetch_array($query)) {
        $arr[strtolower($row['username'])] += 1;
      }
      arsort($arr);
      $arr = array_slice($arr, 0, 10);
      foreach ($arr as $username => $votes) {
        $i++;
        echo "<tr><td>$i</td><td>$username</td><td>$votes</td></tr>";
      }
    ?>
  </table>

  <hr />
  <h3>Last Month Winners</h3><br />
  <table style="width: 300px" class="table table-striped table-bordered">
    <tr>
      <th>#</th>
      <th>Username</th>
      <th>Votes</th>
    </tr>
    <?
      $i = 0;
      connect();
      $arr = array();
      $query = mysql_query("SELECT * FROM votes WHERE username != 'anonymous' AND month(date_sub(now(), interval 1 month))=month(date)");
      while ($row = mysql_fetch_array($query)) {
        $arr[strtolower($row['username'])] += 1;
      }
      arsort($arr);
      $arr = array_slice($arr, 0, 3);
      foreach ($arr as $username => $votes) {
        $i++;
        echo "<tr><td>$i</td><td>$username</td><td>$votes</td></tr>";
      }
    ?>
  </table>
</center>