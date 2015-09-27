<?
include 'inc/functions.php';
$topic = $_GET['topic'];
$author = $_GET['author'];
$lock = $_GET['lock'];

connect();

mysql_query("UPDATE posts SET locked=$lock,created=created WHERE topic=$topic AND title != ''");
flashNotice("You have locked or unlocked a topic!");
if ($topic == 1)
	header('Location: /forum/topic?id=' . $topic);
else
	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>