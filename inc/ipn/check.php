<? require '../functions.php'; connect() ?>
<? echo mysql_num_rows(mysql_query("SELECT id FROM players WHERE subscription_end<now() AND subscription_cancelled=1")) ?>
<?
  mysql_query("UPDATE players SET subscription=null,subscription_end=null,subscription_cancelled=null WHERE subscription_end<now() AND subscription_cancelled=1");
  echo mysql_error();
  echo ' Subscribers Removed';

  
	$p = "INSERT into pets (owner,type,name,age,name_color,spawned,donator) VALUES ";
	$sheep = "INSERT into pets (owner,type,name,color,age,name_color,spawned,donator) VALUES ";
?>

<?
if ($_GET['insert'] == 1) {
	/*
	$i = 0;
	

	
	$q = mysql_query("SELECT * FROM players WHERE subscription='vip'");
	while ($row = mysql_fetch_array($q)) {
		$u = $row['username'];
		$i++;
		echo $u;

		// PIG
		$r = "pig" . $i;
		$s = $p . "('$u','pig','$r','baby','green',0,1)";
		mysql_query($s);
	}

	
	

	$q = mysql_query("SELECT * FROM players WHERE subscription='elite'");
	while ($row = mysql_fetch_array($q)) {
		$u = $row['username'];
		$i++;

		// PIG
		$r = "pig" . $i;
		$s = $p . "('$u','pig','$r','baby','green',0,1)";
		mysql_query($s);

		// SHEEP
		$r = "sheep" . rand(1,150);
		$s = $sheep . "('$u','sheep','$r','white','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "cow" . $i;
		$s = $p . "('$u','cow','$r','baby','green',0,1)";
		mysql_query($s);
	}
  
	
	*/
	$q = mysql_query("SELECT * FROM players WHERE subscription='titan' AND username='DaveTheSecond2'");
	while ($row = mysql_fetch_array($q)) {
		$u = $row['username'];
		$i++;

		// PIG
		$r = "pig" . $i;
		$s = $p . "('$u','pig','$r','baby','green',0,1)";
		mysql_query($s);

		// SHEEP
		$r = "sheep" . rand(1,150);
		$s = $sheep . "('$u','sheep','$r','white','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "cow" . $i;
		$s = $p . "('$u','cow','$r','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "slime" . $i;
		$s = $p . "('$u','slime','$r','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "chicken" . $i;
		$s = $p . "('$u','chicken','$r','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "slime" . $i;
		$s = $p . "('$u','slime','$r','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "magma_cube" . $i;
		$s = $p . "('$u','magma_cube','$r','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "zombie" . $i;
		$s = $p . "('$u','zombie','$r','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "wolf" . $i;
		$s = $p . "('$u','wolf','$r','baby','green',0,1)";
		mysql_query($s);

		// COW
		$r = "villager" . $i;
		$s = $p . "('$u','villager','$r','baby','green',0,1)";
		mysql_query($s);
	}
}

?>