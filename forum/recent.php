<? include '../inc/header.php'; $title = "Recent Topics" ?>
<div class="page-header">
	<h1>Recent Topics</h1>
</div>
<? connect(); ?>

<? $q = mysql_query("SELECT * FROM posts WHERE title IS NOT NULL AND title!='' ORDER BY updated DESC"); ?>

<ul class="breadcrumb">
  <li><a href="/forum">Forums</a> <span class="divider">/</span></li>
  <li class="active">Recent Topics</li>
</ul>

<?php
	include('connect.php');
	$where = "title IS NOT NULL AND title!=''";

	$tableName="posts";		
	$targetpage = "recent"; 	
	$limit = 25;
	$query = "SELECT COUNT(*) as num FROM $tableName WHERE $where ORDER BY updated DESC";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	$stages = 3;
	$page = mysql_escape_string($_GET['page']);
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}	
	
    // Get page data
	$query1 = "SELECT * FROM $tableName WHERE $where ORDER BY updated DESC LIMIT $start, $limit";
	$result = mysql_query($query1);
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	/*
<div class="pagination">
              <ul>
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
	
	*/
		$paginate .= "<div class='pagination'><ul>";
		// Previous
		if ($page > 1){
			$paginate.= "<li><a href='$targetpage?page=$prev'>Prev</a></li>";
		}else{
			$paginate.= "<li class='disabled'><a href='#'>Prev</a></li>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<li class='active'><a href='#'>$counter</a></li>";
				}else{
					$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
			}
		}
		else if($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li class='active'><a href='#'>$counter</a></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
				}
				$paginate.= "<li class='disabled'><a href='#'>...</a><li>";
				$paginate.= "<li><a href='$targetpage?page=$LastPagem1'>$LastPagem1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$lastpage'>$lastpage</a></li>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<li><a href='$targetpage?page=1'>1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=2'>2</a></li>";
				$paginate.= "<li class='disabled'><a href='#'>...</a></li>";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li class='active'><a href='#'>$counter</a></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
				}
				$paginate.= "<li class='disabled'><a href='#'>...</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$LastPagem1'>$LastPagem1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=$lastpage'>$lastpage</a></li>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<li><a href='$targetpage?page=1'>1</a></li>";
				$paginate.= "<li><a href='$targetpage?page=2'>2</a></li>";
				$paginate.= "<li class='disabled'><a href='#'>...</a></li>";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<li class='active'><a href='#'>$counter</a></li>";
					}else{
						$paginate.= "<li><a href='$targetpage?page=$counter'>$counter</a></li>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<li><a href='$targetpage?page=$next'>Next</a></li>";
		}else{
			$paginate.= "<li class='disabled'><a href='#'>Next</a></li>";
			}
			
		$paginate.= "</ul></div>";		
	
	
}
?>
<?    
if ($category != null && loggedIn()) {
  if (!in_array($category, adminCategories()) || $username=="funkystudios") { ?>
  <a class="btn btn-primary pull-right" href="/forum/new?cat=<?= $category ?>">
    New topic
  </a>
  <? } 
} ?>
<? echo $paginate; ?>



<? connect(); ?>

<table class="table">
<thead>
<tr>
  <th style="text-align: center">Topic</th>
  <th style="text-align: center">Posts</th>
  <th style="text-align: center">Views</th>
  <th width="180px"><center>Last Post</center></th></tr>
</thead>
<tbody>
<?
while ($row = mysql_fetch_array($result)) {
  $views = $row['views'];
  $i = 0;
  $recent = null;
 	$category = $row['category'];
 	$private = false;
    if ($category == "Modders or Hackers" || $category == "Team Killers" || $category == "Moderator Applications" || $category == "Staff Discussion")
		$private = true;
	if ($private) {
		continue;
	}
  $q2 = mysql_query("SELECT * FROM posts WHERE topic=" . $row['topic'] . " ORDER BY created DESC");
  while ($row2 = mysql_fetch_array($q2)) {
    if ($recent == null)
      $recent = $row2;
    $i += 1;
    $exit = false;
    if ($row['deleted'] == 1) {
    	$exit = true;
    	if ($row['author'] == $username)
    		$exit = false;
    	else if (getPosition($username) == "admin")
    		$exit = false;
    }

  }
  if ($exit)
  	continue;

  ?>
  <tr class="topic <? echo ($row['sticky']==1) ? "warning" : "" ?>" style="<? echo ($row['deleted']==1) ? "background-color: #F0F0F0" : "" ?>">
    <td>
      <div>
        <a href="/forum/topic?id=<?= $row['topic'] ?>"><?= $row['title'] ?></a> 
        <? echo ($row['sticky']==1) ? '<i title="Sticky Topic" class="icon icon-bookmark"></i>' : "" ?>
        <? echo ($row['locked']==1) ? '<i title="Locked Topic" class="icon icon-lock"></i>' : "" ?>
        <? echo ($row['deleted']==1) ? '<i title="Archived Topic" class="icon icon-remove"></i>' : "" ?>
      </div>
      <small class="started-by">
        by <?= user($row['author']) ?> on
        <?= datetime($row['created'], true) ?>
      </small>
    </td>
    <td style="text-align: center">
      <strong><?= $i ?></strong>
    </td>
    <td style="text-align: center">
      <strong><?= $views ?></strong>
    </td>
    <td>
      <div style="position:relative; text-align: right">
        <a class="pull-right" style="position:relative; margin: 5px;">
          <?= avatar($recent['author'], 32); ?>
        </a>
        <?= user($recent['author']) ?>
        <div>
          <small><?= timeago($recent['created']) ?></small>
        </div>
      </div>
    </td>
  </tr>
  <? } ?>
</tbody>
</table>

<?    
if ($category != null && loggedIn()) {
  if (!in_array($category, adminCategories()) || $username=="funkystudios") { ?>
	<hr />
  <a class="btn btn-primary pull-right" href="/forum/new?cat=<?= $category ?>">
    New topic
  </a>
  <? } 
} ?>
<? echo $paginate; ?>
