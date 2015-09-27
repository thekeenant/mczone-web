<?
connect();
$u = $_GET['username'];
if ($u == null) {
  $u = $username;
}

$exists = false;

$rank = "Member";
$q = mysql_query("SELECT * FROM players WHERE username='$u'");
while ($row = mysql_fetch_array($q)) {
  $u = $row['username'];
  $joined = $row['created'];
  $lastOnline = $row['updated'];
  $lastServer = $row['server'];
  $credits = $row['credits'];
  $email = $row['email'];
  if ($row['subscription'] != null)
    $rank = $row['subscription'];
  $exists = true;
  $id = $row['id'];
}

if (!$exists) {
  flashError("The user, $u, has not played on MC Zone!");
  header("Location: /profiles");
}

?>
<div class="page-header">
  <h1 style="font-size:36px; font-family: Lato; font-weight: 100">Profile: <?= $u ?></h1>
</div>

<div class="alert">
  <b>Notice: </b> Profile page is still being worked on!
</div>

<div class="row">
  <div class="span3" style="width: 174px;">
    <a class="thumbnail" href="/user/<?= $u ?>" style="width: 160px; height: 160px;">
      <img src="/inc/mc/avatar.php?s=160&u=<?= $u ?>" />
    </a>
  </div>
  <div class="span6">
    <table class="table">
      <tr>
        <td><b>Username</b></td>
        <td><?= $u ?></td>
      </tr>
      <tr>
        <td><b>ID</b></td>
        <td><?= $id ?></td>
      </tr>
      <tr>
        <td><b>Joined</b></td>
        <td><?= datetime($joined, true) ?></td>
      </tr>
      <tr>
        <td><b>Last Online</b></td>
        <td><?= timeago($lastOnline) ?> (<?= $lastServer ?>)</td>
      </tr>
      <tr>
        <td><b>Rank</b></td>
        <td><?= color(strtoupper($rank)) ?></td>
      </tr>
      <? if (getPosition($username) == "admin" && $email != "") { ?>
      <tr>
        <td><b>Email</b></td>
        <td><?= $email ?></td>
      </tr>
      <? } ?>
    </table>
  </div>
</div>
<br />
<div class="row">
  <table class="table">
    <tr>
      <td><b>Kills</b></td>
      <td><?= $kills = mysql_num_rows(mysql_query("SELECT id FROM kills WHERE player='$u'")) ?></td>
    </tr>
    <tr>
      <td><b>Deaths</b></td>
      <td><?= $deaths = mysql_num_rows(mysql_query("SELECT id FROM kills WHERE target='$u'")) ?></td>
    </tr>
    <tr>
      <td><b>K/D</b></td>
      <td><?= round($kills/$deaths,3) ?></td>
    </tr>
    <tr>
      <td><b>PVP K/D</b></td>
      <?
        $pvp_deaths = mysql_num_rows(mysql_query("SELECT id FROM kills WHERE target='$u' AND player != 'left' AND player != 'quit' AND player != 'natural'"));
      ?>
      <td><?= round($kills/$pvp_deaths,3) ?></td>
    </tr>
    <tr>
      <td><b>Games</b></td>
      <td>
        <?= 
          $games = 
              mysql_num_rows(mysql_query("SELECT id FROM skywars_players WHERE username='$u'")) +
              mysql_num_rows(mysql_query("SELECT id FROM walls_players WHERE username='$u'")) +
              mysql_num_rows(mysql_query("SELECT id FROM hg_players WHERE username='$u'")) +
              mysql_num_rows(mysql_query("SELECT id FROM sg_players WHERE username='$u'")) +
              mysql_num_rows(mysql_query("SELECT id FROM nexus_players WHERE username='$u'")) +
              mysql_num_rows(mysql_query("SELECT id FROM nebula_players WHERE username='$u'"))
        ?>
      </td>
    </tr>
    <tr>
      <td><b>Forum Topics</b></td>
      <td><?= $posts = mysql_num_rows(mysql_query("SELECT id FROM posts WHERE author='$u' AND title != ''")) ?></td>
    </tr>
    <tr>
      <td><b>Forum Posts</b></td>
      <td><?= $posts = mysql_num_rows(mysql_query("SELECT id FROM posts WHERE author='$u'")) ?></td>
    </tr>
  </table>
</div>