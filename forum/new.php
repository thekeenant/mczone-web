<?
include 'inc/header.php';
$category = $_GET['cat'];
if ($category == null) {
  flashError("No category defined!");
  header("Location: /forum");
}
if ($username == null) {
  flashError("You must first login to create a new post!");
  header("Location: /user/login");
}

?>
<div class="page-header">
  <h2>New Post</h2>
</div>
<ul class="breadcrumb">
  <li><a href="/forum">Forums</a> <span class="divider">/</span></li>
  <li><a href="/forum/category?category=<?= $category ?>"><?= $category ?></a> <span class="divider">/</span></li>
  <li class="active">New Post</li>
</ul>

<div class="row">
  <div class="span2">
    <a class="thumbnail" href="/user/<?= $topic['author'] ?>">
      <?= avatar($username,128) ?>
      <div class="caption" style="text-align: center;">
        <?= color($username) ?>
      </div>
    </a><br />
    <center><small>Posted <?= date('F, jS') ?></small></center>
  </div>
  <div class="span10">
    <form accept-charset="UTF-8" action="/forum/post.php" method="post">
      <input type="hidden" name="category" value="<?= $category ?>"></input>
      <input type="hidden" name="author" value="<?= $username ?>"></input>
      <input type="hidden" name="new" value="1"></input>
      <div>
        <input type="text" name="title" value="<?= $_POST['title'] ?>" placeholder="Topic Title" style="width: 98%"></input>
      </div>
      <div>
        <textarea id="texteditor" value="<?= $_POST['body'] ?>" class="texteditor" cols="40" name="body" rows="17" style="width: 98%"></textarea>
      </div>
      <div>
        <input class="btn btn-primary pull-right" type="submit" value="Post">
      </div>
    </form>
  </div>
</div>