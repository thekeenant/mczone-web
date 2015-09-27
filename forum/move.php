<?
include '../inc/functions.php';
$topic = $_GET['topic'];
$category = $_GET['category'];

connect();

mysql_query("UPDATE posts SET category='$category' WHERE topic=$topic");
flashNotice("You have moved the topic to $category!");
header('Location: /forum/topic?id=' . $topic);

?>