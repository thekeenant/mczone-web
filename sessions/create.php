<?
connect();

// username and password sent from form 
$username=$_POST['username'];
$goto=$_POST['goto']; 
$password=md5("terrascape" . $_POST['password']);

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$sql="SELECT * FROM players WHERE username='$username' and password='$password'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);

if($count>=1){

	while ($row = mysql_fetch_array($result)) {
		$username = $row['username'];
	}

	setcookie("online", true, strtotime( '+7 days' ), "/");
	setcookie("username", $username, strtotime( '+7 days' ), "/");

	echo $_COOKIE['username'];
	flashNotice("You are now logged in as " . $username);
	redirect($goto);
}
else {
	$_COOKIE["online"] = false;
	flashError("Your username and password combination did not work!");
	redirect('/user/login');
}