<!DOCTYPE html>
<? ob_start() ?>
<? include_once('functions.php') ?>
<? $page = ucwords(str_replace(".php", "", basename($_SERVER["SCRIPT_NAME"]))) ?>
<?
$m_time = explode(" ",microtime());
$m_time = $m_time[0] + $m_time[1];
$loadstart = $m_time;
?>
<html lang="en">
<head>
  <meta content="authenticity_token" name="csrf-param">
  <meta content="uKOccHcIsGa++YzNLCy6P+32AHMzKoRHcWroL6LBmbs=" name="csrf-token">
  <meta charset="utf-8">
  <title>
    MC Zone » <?= $page ?>
  </title>


  <link href="/assets/img/favicon.ico?v=2" rel="shortcut icon" type="image/vnd.microsoft.icon">
  <link href="/assets/css/application.css" media="screen" rel="stylesheet" type="text/css">
  <link href="http://datatables.net/media/blog/bootstrap_2/DT_bootstrap.css" media="screen" rel="stylesheet" type="text/css">
  <link href="/assets/css/tables.css" media="screen" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:700,400,300" media="screen" rel="stylesheet" type="text/css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="/assets/js/bootstrap.js" type="text/javascript"></script>
  <script src="/assets/js/tables.js" type="text/javascript"></script>
  <script src="/assets/js/tables.bootstrap.js" type="text/javascript"></script>
  <script src="/assets/js/jquery.ui.js"></script>
  <script src="/assets/js/confirm.js"></script>
  <script src="/assets/js/tipsy.js"></script>
  <script src="/assets/js/highcharts.js"></script>
</head>
<body>

  <div class="modal hide fade" id="play">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>How to Play</h3>
    </div>
    <div class="modal-body">
      <img src="/assets/img/play.png" />
    </div>
    <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
    </div>
  </div>
  <div class="modal hide fade" id="skywars-video">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>Sky Wars 2.0 by JJtCool</h3>
    </div>
    <div class="modal-body">
      <iframe width="525" height="295" src="http://www.youtube.com/embed/OTO7arbYUEI?rel=0" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
    </div>
  </div>

  <div class="modal hide fade" id="walls-video">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>The Walls by Hypixel</h3>
    </div>
    <div class="modal-body">
      <iframe width="525" height="295" src="http://www.youtube.com/embed/HLeXP15vkcM?rel=0" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="modal-footer">
      <a href="#" data-dismiss="modal" class="btn btn-primary">Close</a>
    </div>
  </div>
  <? $p = strtolower($_SERVER['REQUEST_URI']); ?>
  <nav class="navbar navbar-static-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="brand" href="/">
          MC Zone
        </a>
        <div class="nav-collapse">
          <ul class="nav links">
            <li <? if (strstr($p, "games")) {?>class="active"<? } ?>>
              <a href="/games">
                <i class="icon-hdd"></i>
                Games
              </a>
            </li>
            <li <? if (strstr($p, "shop")) {?>class="active"<? } ?>>
              <a href="/shop">
                <i class="icon-shopping-cart"></i>
                Shop
              </a>
            </li>
            <li <? if (strstr($p, "forum")) {?>class="active"<? } ?>>
              <a href="/forum">
                <i class="icon-book"></i>
                Forum
              </a>
            </li>
            <li <? if (strstr($p, "vote")) {?>class="active"<? } ?>>
              <a href="/vote">
                <i class="icon-check"></i>
                Vote
              </a>
            </li>
            <li <? if (strstr($p, "profiles") || strstr($p, "user") && !strstr($p, "?user") && !strstr($p, "donations") && $p != "/user/") {?>class="active"<? } ?>>
              <a href="/profiles">
                <i class="icon-user"></i>
                Profiles
              </a>
            </li>
          </ul>
          <ul class="nav pull-right">
            <li><a href="#"><span class="total-players"><?= players("play.mczone.co") ?></span> players online</a></li>
            <? if (loggedIn()) { ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <!-- <img class="avatar" src="https://avatar.oc.tc/<?= $username ?>/16.png" player="funkystudios" size="16" width="16" height="16" style="width: 16px; height: 16px; "> -->
                Account
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class="nav-header">User: <?= $username ?></li>
                <li <? if ($p == "/user/") {?>class="active"<? } ?>><a href="/user/">Profile</a></li>
                <li <? if (strstr($p, "donations")) {?>class="active"<? } ?>><a href="/user/donations/">Donations</a></li>
                <li><a href="/sessions/destroy/">Logout</a></li>
              </ul>
            </li>
            <? } else { ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                Account 
                <b class="caret"></b>
              </a>
              <ul class="dropdown-menu">
                <li class="nav-header">Logged in as: Guest</li>
                <li>
                  <a href="/user/login">Login</a>
                </li>
                <li>
                  <a href="/user/register">Register</a>
                </li>
              </ul>
            </li>
            <? } ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <?
  $homepage = "/index.php";
  $currentpage = $_SERVER['REQUEST_URI'];
  if("/index.php"==$currentpage || "/"==$currentpage) {
    ?>
    <header class="jumbotron subhead">
      <div class="container">
        <h1>Minecraft Zone</h1>
        <p class="lead">A leading provider of public Minecraft games, determined to make your Minecraft experience the best possible! Join our servers today by selecting a game of your choice!</p>
        <a class="btn btn-primary btn-large" data-toggle="modal" href="#play" >Play Now »</a>
        <a href="/games" class="btn btn-large btn">Games »</a>
      </div>
    </header>
    <div class="bs-docs-social">
      <div class="container">
        <ul class="bs-docs-social-buttons">
          <li class="like-btn">
            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fmczone.co&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font=lucida+grande&amp;height=21&amp;appId=193543290700808"
            scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 73px;
            height: 21px;" allowtransparency="true"></iframe>
          </li>
          <li class="follow-btn">
            <a href="https://twitter.com/mczoneco" class="twitter-follow-button" data-show-count="false">Follow @mczoneco</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </li>
          <li class="tweet-btn">
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mczone.co" data-text="Minecraft Zone Gaming" data-via="mczoneco">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </li>
        </ul>
      </div>
    </div>
    <? } ?>



    <div class="container">
      <style>body{padding-bottom:40px;}</style>
      <? if ($_SESSION['notice'] != '') { ?>
      <br />
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?= $_SESSION['notice'] ?><? $_SESSION['notice'] = '' ?>
      </div>
      <? } ?>

      <? if ($_SESSION['error'] != '') { ?>
      <br />
      <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error: </strong> <?= $_SESSION['error'] ?><? $_SESSION['error'] = '' ?>
      </div>
      <? } ?>

<?
connect();
$q = mysql_query("SELECT * FROM players WHERE username='" . $username . "'");
while ($row = mysql_fetch_array($q)) {
  $ban = $row['forum_ban'];
}

if ($ban == 1) {
?>
<h2>Ban Notice</h2>
<p>
  The account, <?= $username ?>, has broken the forum or website rules and have been banned from MC Zone. If you would like
  to appeal your website ban, please contact us at <a href="mailto:info@mczone.co">info@mczone.co</a>.

  <br /><br />
  If your Minecraft account is not <?= $username ?>, please logout using the button on the top right of this page and disregard
  this message entirely.
</p>
<?
  include('footer.php');
  exit();
}
?>