
<div class="page-header">
  <h1>Forums <small>Socialize with your friends</small></h1>
</div>

<? if ($_GET['category'] != null) { ?>
<ul class="breadcrumb">
  <li><a href="/forum">Forums</a> <span class="divider">/</span></li>
  <li><?= $_GET['category'] ?></li>
</ul>
<? } else { ?>
<ul class="breadcrumb">
  <li>Forums</li>
</ul>
<? } ?>

<div class="row">
  <div class="span3">
    <? include 'sidebar.php' ?>
  </div>
  <div class="span9">

    <?
    $category = $_GET['category'];
    ?>

    <?    
    if ($category != null && loggedIn()) {
      if (!in_array($category, adminCategories()) || $username=="funkystudios") { ?>
      <a class="btn btn-primary btn-small pull-right" href="/forum/new?cat=<?= $category ?>">
        New topic
      </a>
      <? } 
    } ?>
    <h4><? echo ($category == null) ? "Latest Topics" : $category ?></h4><hr />

    <?
    if ($category != null)
      $q = mysql_query("SELECT * FROM posts WHERE title IS NOT NULL AND category LIKE '$category' AND title!='' ORDER BY sticky DESC,created DESC");
    else
      $q = mysql_query("SELECT * FROM posts WHERE title IS NOT NULL AND title!='' ORDER BY updated DESC");


    $pagenum = $_GET['page'];
    $rows = mysql_num_rows($q);
    $page_rows = 15;
    $last = ceil($rows/$page_rows);

    if ($pagenum < 1)
      $pagenum = 1;
    else if ($pagenum > $last)
      $pagenum = $last;
    $max = 'limit ' . ($pagenum - 1) * $page_rows .',' .$page_rows;

    if ($category != null)
      $q = mysql_query("SELECT * FROM posts WHERE title IS NOT NULL AND category LIKE '$category' AND title!='' ORDER BY sticky DESC,created DESC " . $max);
    else
      $q = mysql_query("SELECT * FROM posts WHERE title IS NOT NULL AND title!='' ORDER BY updated DESC " . $max);
    ?>
    <?

    if ($last <= 1) {

    }
    else if ($pagenum == $last) {
      $prev = $pagenum-1;
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=1&category={$category}'>« First </a> ";
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$prev&category={$category}'>Previous</a>";
      echo " <a class='btn btn-small' disabled='disabled'>Next</a>";
      echo " <a class='btn btn-small' disabled='disabled'>Last »</a> ";
    }
    else if ($pagenum == 1) {
      echo " <a class='btn btn-small' disabled='disabled'>« First </a> ";
      echo " <a class='btn btn-small' disabled='disabled'>Previous</a>";
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=2&category={$category}'>Next</a> ";
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$last&category={$category}'>Last »</a> ";
    }
    else {
      $next = $pagenum+1;
      $prev = $pagenum-1;
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=1&category={$category}'>« First </a> ";
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$prev&category={$category}'>Previous</a> ";
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$next&category={$category}'>Next</a> ";
      echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$last&category={$category}'>Last »</a> ";
    } 
    ?>
    <table class="table">
      <thead>
        <tr>
          <th class="byline">
            Topic
          </th>
          <th class="latest-post" width="175px">
            Latest
          </th>
          <th style="text-align: center">Posts</th>
          <th style="text-align: center">Views</th>
        </tr>
      </thead>
      <tbody>
        <?
        while ($row = mysql_fetch_array($q)) {
          $views = $row['views'];
          $i = 0;
          $recent = null;
          $q2 = mysql_query("SELECT * FROM posts WHERE topic=" . $row['topic'] . " ORDER BY created DESC");
          while ($row2 = mysql_fetch_array($q2)) {
            if ($recent == null)
              $recent = $row2;
            $i += 1;
          }

          ?>
          <tr class="topic <? echo ($row['sticky']==1) ? "warning" : "" ?>">
            <td>
              <div>
                <a href="/forum/topic?id=<?= $row['topic'] ?>"><?= $row['title'] ?></a> 
                <? echo ($row['sticky']==1) ? '<i title="Sticky Topic" class="icon icon-bookmark"></i>' : "" ?>
                <? echo ($row['locked']==1) ? '<i title="Locked Topic" class="icon icon-lock"></i>' : "" ?>
              </div>
              <small class="started-by">
                <?= user($row['author']) ?>
                <?= timeago($row['created']) ?>
                <small>in</small>
                <a href="/forum?category=<?= $row['category'] ?>" rel="tooltip">
                  <small><?= $row['category'] ?></small>
                </a>
              </small>
            </td>
            <td>
              <div style="position:relative;">
                <a class="pull-left" style="position:relative; margin: 4px 5px 0 0;">
                  <?= avatar($recent['author'], 32); ?>
                </a>
                <?= user($recent['author']) ?>
                <div>
                  <small><?= timeago($recent['created']) ?></small>
                </div>
              </div>
            </td>
            <td style="text-align: center">
              <strong><?= $i ?></strong>
            </td>
            <td style="text-align: center">
              <strong><?= $views ?></strong>
            </td>
          </tr>
          <? } ?>
        </tbody>
      </table>

      <? 
      if ($last <= 1) {

      }
      else if ($pagenum == $last) {
        $prev = $pagenum-1;
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=1&category={$category}'>« First </a> ";
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$prev&category={$category}'>Previous</a>";
        echo " <a class='btn btn-small' disabled='disabled'>Next</a>";
        echo " <a class='btn btn-small' disabled='disabled'>Last »</a> ";
      }
      else if ($pagenum == 1) {
        echo " <a class='btn btn-small' disabled='disabled'>« First </a> ";
        echo " <a class='btn btn-small' disabled='disabled'>Previous</a>";
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=2&category={$category}'>Next</a> ";
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$last&category={$category}'>Last »</a> ";
      }
      else {
        $next = $pagenum+1;
        $prev = $pagenum-1;
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=1&category={$category}'>« First </a> ";
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$prev&category={$category}'>Previous</a> ";
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$next&category={$category}'>Next</a> ";
        echo " <a class='btn btn-small' href='{$_SERVER['PHP_SELF']}?page=$last&category={$category}'>Last »</a> ";
      } 
      ?>
    </div>
  </div>