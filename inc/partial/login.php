<form accept-charset="UTF-8" action="/sessions/create.php" method="post">
	<input name="goto" type="hidden" value="<?= $_SERVER['HTTP_REFERER'] ?>">
	<div>
		<label>Minecraft Username</label>
		<input name="username" size="30" type="text" value="<?= $_POST['username'] ?>">
	</div>
	<div>
		<label>Password</label>
		<input name="password" size="30" type="password">
	</div>
	<div>
		<input class="btn btn-primary" type="submit" value="Login">
	</div>
</form>