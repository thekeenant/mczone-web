<?
include 'inc/functions.php';
$category = $_POST['category'];
$topic = $_POST['topic'];
$title = $_POST['title'];
$title = str_replace("'", "\'", $title);
$id = $_POST['post_id'];
$body = $_POST['body'];
$body = str_replace("'", "\'", $body);
//$body = rtrim($body, "<br />");
connect();

if ($username == null || $username == "") {
  flashError("You must be logged in to create a new post!");
  header('Location: /user/login');
  exit();
}

if ($_POST['edit'] == 1) {
  echo $body . " AND " . $id;
  mysql_query("UPDATE posts SET created=created,category='$category',title='$title',body='$body' WHERE id=$id");
  flashNotice("You have edited your post!");
  header('Location: /forum/topic?id=' . $topic);
  exit();
}


if ($_POST['new'] == 1) {
	$q = mysql_query("SELECT topic FROM posts ORDER BY topic DESC limit 1");
	$topic = 1;
	while ($row = mysql_fetch_array($q)) {
		$topic = $row['topic'] + 1;
		break;
	}
}

// Insert new post
$q = mysql_query("INSERT INTO posts (category,topic,title,author,body,updated) VALUES ('$category',$topic,'$title','$username','$body',now())");
while ($row = mysql_fetch_array($q)) {
	$id = $row['topic'];
}
// Update the main post
mysql_query("UPDATE posts SET created=created,updated=now() WHERE topic=$topic AND title != ''");

flashNotice("You have created a post!");
header('Location: /forum/topic?id=' . $topic);
exit();
?>