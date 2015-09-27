<div class="page-header">
	<h1>Staff</h1>
</div>
<div class="row">
	<div class="span12">

	<? connect();
	$q = mysql_query("SELECT username FROM players WHERE subscription='admin' ORDER BY username"); ?>
	<h2>Administrators <small>(<?= mysql_num_rows($q) ?>)</small></h2><hr />
	<ul class="thumbnails">
	<? while ($row = mysql_fetch_array($q)) {	?>

	<li class="span2" rel="tooltip">
		<a class="thumbnail" href="/user/<?= $row['username'] ?>">
			<?= avatar($row['username'],148) ?>
			<div class="caption" style="text-align: center;">
				<?= color($row['username']) ?>
			</div>
		</a>
	</li>
	<? } ?>
</ul>

	<? connect();
	$q = mysql_query("SELECT username FROM players WHERE subscription='mod' ORDER BY username"); ?>
	<h2>Moderators <small>(<?= mysql_num_rows($q) ?>)</small></h2><hr />
<ul class="thumbnails">
	<? while ($row = mysql_fetch_array($q)) {	?>
	<li class="span2" rel="tooltip">
		<a class="thumbnail" href="/user/<?= $row['username'] ?>">
			<?= avatar($row['username'],148) ?>
			<div class="caption" style="text-align: center;">
				<?= color($row['username']) ?>
			</div>
		</a>
	</li>
	<? } ?>
</ul>
</div>
</div>