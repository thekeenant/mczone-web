<?
connect();
$q = mysql_query("SELECT count(*) FROM players");
while ($row = mysql_fetch_array($q)) {
  $playerCount = $row['count(*)'];
}
?>

<div class="row marketing">
  <h1>What we have to offer...</h1>
  <p class="marketing-byline">Need reasons to love Minecraft Zone? Look no further.</p>

  <div class="span4">
    <i class="icon-bolt icon-large"></i>
    <h2>Instant Action</h2>
    <p>
      With a multitude of different games, a plethora of lag-free servers running these games, and an outstanding uptime of over 97%, we 
      can ensure you will be able to find a game to play on right a way without any hassle or confusion.
    </p>
  </div>
  <div class="span4">
    <i class="icon-globe icon-large"></i>
    <h2>Competition</h2>
    <p>
      Since MC Zone started, <?= number_format($playerCount) ?> unique players have joined and have played on our servers; Thousands of new
      players join every day! Find new players to fight each game and keep track of your stats here on the website!
    </p>
  </div>
  <div class="span4">
    <i class="icon-group icon-large"></i>
    <h2>Community Help</h2>
    <p>
      We have a community full of dedicated users, moderators and administators that are willing to assist you.
      If you ever need help or need to address a concern, just contact us via email or the MC Zone forums.
    </p>
  </div>

  <div class="span12">
    <p></p>
  </div>
</div>