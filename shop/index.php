<div class="page-header">
	<h1>Shop</h1>
</div>

<?
	$user = $username;
	if ($_GET['username'] != null)
		$user = $_GET['username'];
?>

<div class="row">
	<div class="span4">
		<h4>What's the shop?</h4>
		<p>
			The shop is a place for users to improve their overall experience on MC Zone. Here you
			can purchase account upgrades, various pets, and game kits. Find an option that is right
			for you below.
		</p>
	</div>
	<div class="span4">
		<h4>What is the money used for?</h4>
		<p>
			We can guarantee all payments to MC Zone will go towards one of the following:
		</p>
		<ul>
			<li>Server Costs</li>
			<li>Developers</li>
		</ul>
	</div>
	<div class="span4">
		<h4>Questions</h4>
		<p>
			If you have any questions regarding the MC Zone shop, feel free to contact the us at
			<a href="mailto:info@mczone.co">info@mczone.co</a>
		</p>
	</div>
</div>
<hr />
<? if ($user == null) { ?>
	<center>
		<p>Enter your Minecraft username</p>
		<form action="/shop" class="form-inline" method="get">
			<input class="span2" name="username" placeholder="Username" type="text">
			<input class="btn btn-primary" type="submit" value="Find Player">
		</form>
	</center>
<? } else { ?>


	<?
		$q = mysql_query("SELECT * FROM players WHERE username='$user'");
		if (mysql_num_rows($q) == 0) {
		?>
		<div class="alert alert-error">
			<b>Error: </b>Couldn't find the user, <b><?= $user ?></b>
		</div>
		<center>
			<p>Enter your Minecraft username</p>
			<form action="/shop" class="form-inline" method="get">
				<input class="span2" name="username" placeholder="Username" type="text">
				<input class="btn btn-primary" type="submit" value="Find Player">
			</form>
		</center>
		<?
		include("../inc/footer.php");
		exit();
		}
		else {
	?>

	<div class="well">
		The minecraft user, <b><?= $user ?></b>, will receieve any benefits that you purchase. To change this, click <a href="/shop">here</a>.
	</div>

	<?
		}
	?>

	<div class="thumbnails">
		<a class="rank-link" href="/shop/upgrade?username=<?= $user ?>">
			<div class="span4">
				<div class="thumbnail rank">
					<img src="http://media-mcw.cursecdn.com/9/90/Diamond_%28Gem%29.png" />
					<div class="caption">
						<h1 class="lead">Upgrade Your Account</h1>
						<p>For a monthly price, upgrade your account to VIP, Elite or Titan</p>
					</div>
				</div>
			</div>
		</a>
		<a class="rank-link" href="/shop/pets?username=<?= $user ?>">
			<div class="span4">
				<div class="thumbnail rank">
					<img src="https://si0.twimg.com/profile_images/1442541914/sheep.png" style="height: 150px" />
					<div class="caption">
						<h1 class="lead">Buy Pets</h1>
						<p>Purchase a variety of pets to accompany you in the lobby</p>
					</div>
				</div>
			</div>
		</a>
		<a class="rank-link" href="#kits" data-toggle="modal">
			<div class="span4">
				<div class="thumbnail rank">
					<img src="http://www.minecraftopia.com/images/blocks/iron_chestplate.png" style="height: 150px" />
					<div class="caption">
						<h1 class="lead">Get Kits</h1>
						<p>Kits can make or break your game. Explore a variety of them here.</p>
					</div>
				</div>
			</div>
		</a>
	</div>


	<div class="modal hide fade" id="kits">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Buy Kits</h3>
		</div>
		<div class="modal-body">
			<p>
				Kits can be purchased on one of the following pages:
			</p>
			<ul>
				<li><a href="/games/walls">The Walls</a></li>
				<li><a href="/games/nexus">Nexus MC</a></li>
				<li><a href="/games/hg">The Hunger Games</a></li>
				<li><a href="/games/skywars">Sky Wars</a></li>
			</ul>
		</div>
		<div class="modal-footer">

			<a href="#" data-dismiss="modal" class="btn">Close</a>
		</div>
	</div>
<? } ?>