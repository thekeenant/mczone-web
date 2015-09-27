<?
include 'inc/functions.php';
$topic = $_GET['topic'];
$author = $_GET['author'];
$sticky = $_GET['sticky'];

connect();
mysql_query("UPDATE posts SET sticky=$sticky,created=created WHERE topic=$topic AND title != ''");
flashNotice("You have stuck or unstuck a topic!");
if ($topic == 1)
	header('Location: /forum/topic?id=' . $topic);
else
	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>