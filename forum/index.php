<? include '../inc/header.php'; $title = "Forums" ?>
<? $icon = '<img src="http://findicons.com/files/icons/573/must_have/32/copy.png" style="position:inline; width: 28px" /> &nbsp;&nbsp;&nbsp; '; ?>
<div class="page-header">
	<h1>MC Zone  Forums</h1>
</div>
<? connect(); ?>

<table class="table">
	<? if (getPosition($username) == "admin" || getPosition($username) == "mod") { ?>
		<tr>
		<?
			$topic = "Staff Discussion";
			$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
			$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
			$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
			while ($row = mysql_fetch_array($q)) {
				$author = $row['author'];
				$id = $row['topic'];
				$time = timeago($row['created']);
			}
			?>
			<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
			<td><b><?= $threads ?></b><br />threads</td>
			<td><b><?= $posts ?></b><br />posts</td>
			<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
		</tr>
	<? } ?>
	<tr>
	<?
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND deleted=0"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts"));
		$q = mysql_query("SELECT * FROM posts ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="recent">Recent Topics</a></h5></td>
</table>

<h3>MC Zone</h3>
<table class="table">
	<tr>
		<? 
		$topic = "Official News";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' AND deleted=0 ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Moderator Applications";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts WHERE category='$topic' AND deleted=0 ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Website Bugs";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Server Bugs";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' AND deleted=0 ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Ask the Staff";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' AND deleted=0 ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
</table>

<h3>Main</h3>
<table class="table table-">
	<tr>
		<? 
		$topic = "General Discussion";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' AND deleted=0 ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?></a><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Map Discussion";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Suggestions";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Media";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
</table> 

<h3>Other</h3>
<table class="table table-">
	<tr>
		<? 
		$topic = "Minecraft Discussion";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Off Topic";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
</table>

<h3>Report Players</h3>
<table class="table table-">
	<tr>
		<? 
		$topic = "Modders or Hackers";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
	<tr>
		<? 
		$topic = "Team Killers";
		$threads = mysql_num_rows(mysql_query("SELECT id from posts WHERE title != '' AND category='$topic'"));
		$posts = mysql_num_rows(mysql_query("SELECT id from posts WHERE category='$topic'"));
		$q = mysql_query("SELECT * FROM posts where category='$topic' ORDER BY created DESC LIMIT 1");
		while ($row = mysql_fetch_array($q)) {
			$author = $row['author'];
			$id = $row['topic'];
			$time = timeago($row['created']);
		}
		?>
		<td class="forum-icon" style="width: 50%"><h5 class="category"><?= $icon ?><a href="category?category=<?= $topic ?>"><?= $topic ?></a></h5></td>
		<td><b><?= $threads ?></b><br />threads</td>
		<td><b><?= $posts ?></b><br />posts</td>
		<td style="text-align: right"><a class="pull-right" style="position:relative; margin: 5px;"><?= avatar($author, 32); ?><a href="topic?id=<?= $id ?>">Last post by <?= $author ?></a><br /><?= $time ?></td>
	</tr>
</table>