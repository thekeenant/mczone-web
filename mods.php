<?
$pos = getPosition($username);
if ($post != "mod" && $pos != "admin") {
	header('Location: /user/login');
	exit();
}
?>