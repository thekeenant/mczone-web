<?
	$user = $username;
	if ($_GET['username'] != null)
		$user = $_GET['username'];
	if ($user == null) {
		flashError("Type in your username below");
		header("Location: /shop");
		exit();
	}
?>

<div class="page-header">
	<h1>Account Upgrade <small><a class="back" title="Back to Shop" href="/shop?username=<?= $user ?>"><i class="icon icon-reply"></i></a></small></h1>
</div>

<h4>Looking for a pet?</h4>
<p>
	Welcome to the pet shop! Here you can buy various pets that will accompany you on the lobby servers of MC Zone! Remember to use the command <b>/pet</b> to spawn, rename, and
	customise your pet. Your pet's name will be shown above the creature, but remember, you can only have one pet spawned at a time!
</p>
<hr />
<div class="well">
	The minecraft user, <b><?= $user ?></b>, will receieve any benefits that you purchase. To change this, click <a href="/shop">here</a>.
</div>
<ul class="thumbnails">
	<li class="span3" style="width: 220px">
		<div class="thumbnail" style="text-align: center">
			<img src="/assets/img/pets/chicken.jpg" />
			<div class="caption">
				<h1 class="lead">Baby Chicken</h1>
				<p>
					The smallest animal in the game of Minecraft.
				</p>

				<form style="display:inline" action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="custom" value="<?= $user ?>">
					<input type="hidden" name="item_name" value="chicken">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="kt.funky@gmail.com">
					<input type="hidden" name="item_number" value="1">  
					<input type="hidden" name="amount" class="price" value="5">  
					<input type="hidden" name="no_shipping" value="0">  
					<input type="hidden" name="no_note" value="1">  
					<input type="hidden" name="currency_code" value="USD">  
					<input type="hidden" name="lc" value="AU">
					<input type="hidden" name="bn" value="PP-BuyNowBF">  
					<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/pets.php" />
					<input type="hidden" name="return" value="http://mczone.co?notify=payment">
					<button type="submit" class="btn btn-primary">
						Buy ($5.00)
					</button>
				</form>
			</div>
		</div>
	</li>
	<li class="span3" style="width: 220px">
		<div class="thumbnail" style="text-align: center">
			<img src="/assets/img/pets/cow.jpg" />
			<div class="caption">
				<h1 class="lead">Baby Cow</h1>
				<p>
					Because who wouldn't want to have a baby cow?
				</p>

				<form style="display:inline" action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="custom" value="<?= $user ?>">
					<input type="hidden" name="item_name" value="cow">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="kt.funky@gmail.com">
					<input type="hidden" name="item_number" value="1">  
					<input type="hidden" name="amount" class="price" value="7.50">  
					<input type="hidden" name="no_shipping" value="0">  
					<input type="hidden" name="no_note" value="1">  
					<input type="hidden" name="currency_code" value="USD">  
					<input type="hidden" name="lc" value="AU">
					<input type="hidden" name="bn" value="PP-BuyNowBF">  
					<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/pets.php" />
					<input type="hidden" name="return" value="http://mczone.co?notify=payment">
					<button type="submit" class="btn btn-primary">
						Buy ($7.50)
					</button>
				</form>
			</div>
		</div>
	</li>
	<li class="span3" style="width: 220px">
		<div class="thumbnail" style="text-align: center">
			<img src="/assets/img/pets/sheep.jpg" />
			<div class="caption">
				<h1 class="lead">Baby Sheep</h1>
				<p>
					Use <b>/pet color</b> to customize the color of your baby sheep!
				</p>

				<form style="display:inline" action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="custom" value="<?= $user ?>">
					<input type="hidden" name="item_name" value="sheep">
					<input type="hidden" name="cmd" value="_xclick">
					<input type="hidden" name="business" value="kt.funky@gmail.com">
					<input type="hidden" name="item_number" value="1">  
					<input type="hidden" name="amount" class="price" value="10.00">  
					<input type="hidden" name="no_shipping" value="0">  
					<input type="hidden" name="no_note" value="1">  
					<input type="hidden" name="currency_code" value="USD">  
					<input type="hidden" name="lc" value="AU">
					<input type="hidden" name="bn" value="PP-BuyNowBF">  
					<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/pets.php" />
					<input type="hidden" name="return" value="http://mczone.co?notify=payment">
					<button type="submit" class="btn btn-primary">
						Buy ($10.00)
					</button>
				</form>
			</div>
		</div>
	</li>
</ul>

<center><h5>More pets coming soon!</h5></center>
