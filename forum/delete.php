<?
include 'inc/functions.php';
$topic = $_GET['topic'];
$id = $_GET['id'];
$author = $_GET['author'];


connect();

mysql_query("UPDATE posts SET created=created,updated=updated,deleted=1 WHERE id=$id");
flashNotice("You have archived the post!");
if ($topic == 1)
	header("Location: /forum/topic?id=$topic");
else
	header('Location: ' . $_SERVER['HTTP_REFERER']);

?>