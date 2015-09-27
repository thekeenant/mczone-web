<?
include '../functions.php';
connect();

$q = mysql_query("SELECT * FROM players WHERE subscription='admin'");
while ($row = mysql_fetch_array($q)) {
	echo $row['username'] . ",";
}
?>