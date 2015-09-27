<?
include '../inc/header.php';
if ($_GET['id'] == null) {
  flashError("Please supply a post ID!");
  header("Location: /forum");
}
$id = $_GET['id'];

connect();
$q = mysql_query("SELECT * FROM posts WHERE id=$id");
while ($row = mysql_fetch_array($q)) {
  $category = $row['category'];
  $title = $row['title'];
  $author = $row['author'];
  $body = $row['body'];
  $topic = $row['topic'];
  $created = $row['created'];
}

$q = mysql_query("SELECT * FROM posts WHERE topic=$topic AND title != ''");
while ($row = mysql_fetch_array($q)) {
  $topic_title = $row['title'];
  $sticky = $row['sticky'];
  $locked = $row['locked'];
}

if ($author != $username && getPosition($username) != "admin") {
  flashError("You are not the author of that post!");
  header("Location: /forum");
}

?>

<div class="page-header">
  <h2>
    Re: <?= $topic_title ?>
    <small>
      <? echo ($sticky==1) ? '<i title="Sticky Topic" class="icon icon-bookmark"></i>' : "" ?>
      <? echo ($locked==1) ? '<i title="Locked Topic" class="icon icon-lock"></i>' : "" ?>
      by
      <?= user($author) ?>
    </small>
  </h2>
</div>

<ul class="breadcrumb">
  <li><a href="/forum">Forums</a> <span class="divider">/</span></li>
  <li><a href="/forum?cat=<?= $category ?>"><?= $category ?></a> <span class="divider">/</span></li>
  <li><a href="/forum/topic?id=<?= $topic ?>"><?= $topic_title ?></a> <span class="divider">/</span></li>
  <li class="active">Edit Post</li>
</ul>

<div class="row">
  <div class="span2">
    <a class="thumbnail" href="/user/<?= $topic['author'] ?>">
      <?= avatar($author,128) ?>
      <div class="caption" style="text-align: center;">
        <?= color($author) ?>
      </div>
    </a><br />
    <center><small>Posted <?= timeago($created) ?></small></center>
  </div>
  <div class="span9">
    <form accept-charset="UTF-8" action="/forum/post.php" method="post">
      <input type="hidden" name="topic" value="<?= $topic ?>"></input>
      <input type="hidden" name="post_id" value="<?= $id ?>"></input>
      <input type="hidden" name="author" value="<?= $username ?>"></input>
      <input type="hidden" name="edit" value="1"></input>
      <? if ($title != "") { ?>
      <div>
        <input type="text" name="title" value="<?= $title ?>" style="width: 98%"></input>
      </div>
      <? } ?>
      <div>
        <textarea id="texteditor" class="texteditor" cols="40" name="body" rows="17" style="width: 98%">
          <?= $body ?>
        </textarea>
      </div>
      <? if ($username == "funkystudios") { ?>
      <div>
        <input type="text" name="category" value="<?= $category ?>" style="width: 98%"></input>
      </div>
      <? } else { ?>
      <input type="hidden" name="category" value="<?= $category ?>"></input>
      <? } ?>
      <div>
        <input class="btn btn-primary pull-right" type="submit" value="Submit Changes">
      </div>
    </form>
  </div>
</div>