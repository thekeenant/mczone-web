<? connect() ?>

<div class="row">
	<div class="span12">
		<table class="table table-bordered table-striped table-no-sort">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th width="13%">Punished</th>
					<th width="15%">Reason</th>
					<th width="13%">Staff</th>
					<th width="7%">Type</th>
					<th width="20%">Date</th>
					<th width="20%">Expires</th>
				</tr>
			</thead>
			<tbody>
				<?
				$q = mysql_query("SELECT * FROM infractions ORDER BY date DESC");
				$c = mysql_num_rows($q);
				while ($row = mysql_fetch_array($q)) {
					?>
					<tr>
						<td><?= $row['id'] ?></td>
						<td><? echo ($row['username']=="CONSOLE") ? "CONSOLE" : user($row['username']) ?></td>
						<td><?= limit_text($row['reason'],17) ?></td>
						<td><? echo ($row['staff']=="CONSOLE") ? "<i>System</i>" : user($row['staff']) ?></td>
						<td><?= ucwords($row['type']) ?></td>
						<td><?= ucfirst(datetime($row['date'])) ?></td>
						<td><? echo ($row['type'] == "tempban") ? datetime($row['end']) : "" ?></td>
					</tr>
					<?
				}
				?>
			</tbody>
		</table>
	</div>
</div>
