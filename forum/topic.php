<?
include 'inc/header.php';
$id = $_GET['id'];
connect();

$topic = array();

$q = mysql_query("SELECT * FROM posts WHERE topic=$id ORDER BY created ASC LIMIT 1");
while ($row = mysql_fetch_array($q)) {
  $title = $row['title'];
  $author = $row['author'];
  $category = $row['category'];
  $sticky = ($row['sticky'] == 1) ? true : false;
  $locked = ($row['locked'] == 1) ? true : false;
  $deleted = ($row['deleted'] == 1) ? true : false;
  break;
}


if ($title == null) {
  flashError("That forum topic was not found! Error: " . $_GET['id']);
  header("Location: /forum");
}

if ($category == "Modders or Hackers" || $category == "Team Killers" || $category == "Moderator Applications")
  $private = true;

if ($private && $id != 15) {
  if (getPosition($username) != "mod" && getPosition($username) != "admin" && $author != $username) {
    flashError("You are not allowed to view that page!");
    header("Location: /forum");
  }
}

?>
<div class="page-header">
  <h2>
    <?= $title ?>
    <small>
      <? echo ($sticky==1) ? '<i title="Sticky Topic" class="icon icon-bookmark"></i>' : "" ?>
      <? echo ($locked==1) ? '<i title="Locked Topic" class="icon icon-lock"></i>' : "" ?>
        <? echo ($deleted==1) ? '<i title="Archived Topic" class="icon icon-remove"></i>' : "" ?>
      by
      <?= user($author) ?>
    </small>
  </h2>
</div>

<ul class="breadcrumb">
  <li><a href="/forum">Forums</a> <span class="divider">/</span></li>
  <li><a href="/forum/category?category=<?= $category ?>"><?= $category ?></a> <span class="divider">/</span></li>
  <li class="active"><?= $title ?></li>
</ul>

<?
mysql_query("UPDATE posts SET views=views+1,created=created WHERE topic=$id AND title != ''");

$q = mysql_query("SELECT * FROM posts WHERE topic=$id ORDER BY created ASC");
while ($row = mysql_fetch_array($q)) {
  $c += 1;
  $topic = $row;
  if ($row['title'] == "")
    if ($row['deleted'] == 1)
      continue;
  ?>

  <div class="row">
    <div class="span2">
      <a class="thumbnail" href="/user/<?= $topic['author'] ?>">
        <?= avatar($topic['author'],128) ?>
        <div class="caption" style="text-align: center;">
          <?= color($topic['author']) ?>
        </div>
      </a><br />
      <center><small>Posted <?= timeago($topic['created']) ?></small></center>
    </div>
    <div class="span10">
      <? if ($username == $topic['author'] || getPosition($username) == "mod" || getPosition($username) == "admin") { ?>
      <ul class="nav pull-right">
        <li class="dropdown pull-right">
          <a class="dropdown-toggle btn btn-small" data-toggle="dropdown" href="#">
            Actions 
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="/forum/edit.php?id=<?= $topic['id'] ?>">Edit</a>
            </li>
            <? if ($row['deleted'] == 0) { ?>
              <li>
                <a href="/forum/delete?id=<?= $topic['id'] ?>&topic=<?= $topic['id'] ?>&author=<?= $row['author'] ?>">Delete</a>
              </li>
            <? } else { ?>
              <li>
                <a href="/forum/undelete?id=<?= $topic['id'] ?>&topic=<?= $topic['id'] ?>&author=<?= $row['author'] ?>">Restore</a>
              </li>
            <? } ?>
            <? if ($c == 1) { ?>
              <? if (getPosition($username) == "admin") { ?>
                <li>
                  <a href="/forum/sticky?sticky=<? echo ($sticky==1) ? "0" : "1" ?>&topic=<?= $row['topic'] ?>&author=<?= $row['author'] ?>"><? echo ($sticky==0) ? "Sticky" : "Unsticky" ?></a>
                </li>
              <? } ?>
              <? if (getPosition($username) == "mod" || getPosition($username) == "admin") { ?>
                <li>
                  <a href="/forum/lock?lock=<? echo ($locked==1) ? "0" : "1" ?>&topic=<?= $row['topic'] ?>&author=<?= $row['author'] ?>"><? echo ($locked==0) ? "Lock" : "Unlock" ?></a>
                </li>
              <? } ?>
            <? } ?>
          </ul>
        </li>
      </ul>
      <? } ?>
      <p><?= $topic['body'] ?></p>
    </div>
  </div>
  <br>
  <hr />

  <? } ?>

  <div class="row">
    <div class="span2">
    </div>
    <div class="span10">
      <? if (loggedIn()) { ?>
        <? if ($locked || $deleted) { ?>
          <h4>This topic is locked from further posts <small>An admin has prevented additional posts</small></h4>
        <? } else if (!$deleted) { ?>
          <h4>Reply to topic <small>Have your say on the topic</small></h4>
          <form accept-charset="UTF-8" action="/forum/post.php" method="post">
            <input type="hidden" name="category" value="<?= $category ?>"></input>
            <input type="hidden" name="topic" value="<?= $id ?>"></input>
            <input type="hidden" name="author" value="<?= $username ?>"></input>
            <div>
              <textarea id="texteditor" class="texteditor" cols="40" name="body" rows="17" style="width: 98%"></textarea>
            </div>
            <div>
              <input class="btn btn-primary pull-right" type="submit" value="Post">
            </div>
          </form>
        <? } ?>
      <? } else { ?>
        <h4>Log in to reply to this topic! <small>Please <a href="/user/login">login</a> or <a href="/sessions/register">register</a></small></h4>
      <? } ?>
    </div>
  </div>