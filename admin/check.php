<? include 'functions.php' ?>
<? connect() ?>
<? 
	mysql_query("UPDATE players SET subscription=null,subscription_end=null,subscription_cancelled=0 WHERE subscription_end<now() AND subscription_cancelled=1");
	echo mysql_error();
?>