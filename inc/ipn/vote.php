<?
include_once '../functions.php';
connect();


if (!$_POST) {
  exit(0);
}


$username = $_POST["username"];
$password = $_POST["password"];


if ($password != null) {
mysql_query("INSERT INTO votes (username, server, date) VALUES ('$username','$password',now());");

  $arr = walls_kits();
  $kit = strtolower($arr[array_rand($arr)]);
  mysql_query("INSERT INTO walls_donations (username,kit,free) VALUES ('" . $username . "','" . $kit . "',1)");

  file_get_contents("http://mczone.co/inc/mc/mczone.php?server=walls&cmd=/say+" . $username . "+just+voted+and+got+the+kit,+$kit!+vote.mczone.co");
  $yes = true;

  $arr = skywars_kits();
  $kit = strtolower($arr[array_rand($arr)]);
  mysql_query("INSERT INTO skywars_donations (username,kit,free) VALUES ('" . $username . "','" . $kit . "',1);");

  file_get_contents("http://mczone.co/inc/mc/mczone.php?server=skywars&cmd=/say+" . $username . "+just+voted+and+got+the+kit,+$kit!+vote.mczone.co");
  $yes = true;

  $arr = hg_kits();
  $kit = strtolower($arr[array_rand($arr)]);
  mysql_query("INSERT INTO hg_donations (username,kit,free) VALUES ('" . $username . "','" . $kit . "',1);");

  file_get_contents("http://mczone.co/inc/mc/mczone.php?server=hg&cmd=/say+" . $username . "+just+voted+and+got+the+kit,+$kit!+vote.mczone.co");
  $yes = true;
}
/*
else if ($password == "main") {
  mysql_query("UPDATE players SET credits=credits+50 WHERE username='$username'");
  $yes = true;
}
*/

?>
