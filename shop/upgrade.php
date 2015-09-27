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


<h4>Upgrading your account?</h4>
<p>
	You've come to the right place! Here you can upgrade to either VIP, Elite or Titan, depending on the benefits you want.
	To learn more about about an upgrade or to purchase one, click the one of your choice below.
</p>
<hr />
<div class="well">
	The minecraft user, <b><?= $user ?></b>, will receieve any benefits that you purchase. To change this, click <a href="/shop">here</a>.
</div>
<div class="thumbnails">
	<a class="rank-link" href="#vip" data-toggle="modal">
		<div class="span4">
			<div class="thumbnail rank">
				<img src="http://media-mcw.cursecdn.com/3/37/Golditm.png" />
				<div class="caption">
					<h1 class="lead">VIP</h1>
					<p>$5 per month or $20 for 6 months</p>
				</div>
			</div>
		</div>
	</a>
	<a class="rank-link" href="#elite" data-toggle="modal">
		<div class="span4">
			<div class="thumbnail rank">
				<img src="http://media-mcw.cursecdn.com/6/6a/Emerald.png" />
				<div class="caption">
					<h1 class="lead">ELITE</h1>
					<p>$10 per month or $45 for 6 months</p>
				</div>
			</div>
		</div>
	</a>
	<a class="rank-link" href="#titan" data-toggle="modal">
		<div class="span4">
			<div class="thumbnail rank">
				<img src="http://media-mcw.cursecdn.com/9/90/Diamond_%28Gem%29.png" />
				<div class="caption">
					<h1 class="lead">TITAN</h1>
					<p>$20 per month or $80 for 6 months</p>
				</div>
			</div>
		</div>
	</a>
</div>



<div class="modal hide fade" id="vip">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>MC Zone VIP Rank</h3>
	</div>
	<div class="modal-body">
		<p>Basics</p>
		<ul>
			<li><b>Gold [VIP] Prefix:</b> Appears before your username</li>
			<li><b>Instant Credits:</b> 500c</li>
			<li><b>Reserved Slot:</b> Login to any server that is full</li>
		</ul>
		<p>Kits</p>
		<ul>
			<li><b>Hunger Games:</b> Healer, Tank, Enchanter</li>
		</ul>
		<p>Pets*</p>
		<ul>
			<li>Baby Pig</li>
		</ul>

		* Pets can be spawned in the lobby with <i>/pet spawn</i>
	</div>
	<div class="modal-footer">
		<form style="display:inline" action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick-subscriptions">
			<input type="hidden" name="business" value="kt.funky@gmail.com">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="src" value="1">
			<input type="hidden" name="a3" value="5.00">
			<input type="hidden" name="p3" value="1">
			<input type="hidden" name="t3" value="M">
			<input type="hidden" name="amount1" value="0.00">

			<input type="hidden" name="period1" value="0d">
			<input type="hidden" name="currency_code" value="USD">

			<input type="hidden" name="item_name" value="VIP">
			<input type="hidden" name="custom" id="custom" value="<? echo $user ?>">
			<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/subscription.php" />
			<input type="hidden" name="return" value="http://mczone.co">
			<button type="submit" class="btn btn-primary check">
				<b>$5</b> per month
			</button>
		</form>

		<form style="display:inline" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="custom" value="<?= $user ?>">
			<input type="hidden" name="item_name" value="vip_6">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="kt.funky@gmail.com">
			<input type="hidden" name="item_number" value="1">  
			<input type="hidden" name="amount" class="price" value="20">  
			<input type="hidden" name="no_shipping" value="0">  
			<input type="hidden" name="no_note" value="1">  
			<input type="hidden" name="currency_code" value="USD">  
			<input type="hidden" name="lc" value="AU">
			<input type="hidden" name="bn" value="PP-BuyNowBF">  
			<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/six_month.php" />
			<input type="hidden" name="return" value="http://mczone.co?notify=payment">
			<button type="submit" class="btn btn-success">
				<b>$20</b> for 6 months
			</button>
		</form>

		<a href="#" data-dismiss="modal" class="btn">Close</a>
	</div>
</div>

<div class="modal hide fade" id="elite">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>MC Zone Elite Rank</h3>
	</div>
	<div class="modal-body">
		<p>Basics</p>
		<ul>
			<li><b>Green [Elite] Prefix:</b> Appears before your username</li>
			<li><b>Instant Credits:</b> 1250c</li>
			<li><b>Reserved Slot:</b> Login to any server that is full</li>
			<li><b>No AFK Kick:</b> You won't be kicked from the lobby for being AFK</li>
			<li><b>Hat:</b> Use <i>/hat</i> in the lobby to wear any block as your helmet</li>
		</ul>
		<p>Kits</p>
		<ul>
			<li><b>Hunger Games:</b> Healer, Tank, Enchanter, Chemist, Pyro</li>
			<li><b>The Walls:</b> Archer, Warrior, Beastmaster</li>
		</ul>
		<p>Pets*</p>
		<ul>
			<li>Baby Pig</li>
			<li>Baby Sheep</li>
			<li>Baby Cow</li>
		</ul>

		* Pets can be spawned in the lobby with <i>/pet spawn</i>
	</div>
	<div class="modal-footer">
		<form style="display:inline" action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick-subscriptions">
			<input type="hidden" name="business" value="kt.funky@gmail.com">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="src" value="1">
			<input type="hidden" name="a3" value="10.00">
			<input type="hidden" name="p3" value="1">
			<input type="hidden" name="t3" value="M">
			<input type="hidden" name="amount1" value="0.00">

			<input type="hidden" name="period1" value="0d">
			<input type="hidden" name="currency_code" value="USD">

			<input type="hidden" name="item_name" value="Elite">
			<input type="hidden" name="custom" id="custom" value="<? echo $user ?>">
			<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/subscription.php" />
			<input type="hidden" name="return" value="http://mczone.co">
			<button type="submit" class="btn btn-primary check">
				<b>$10</b> per month
			</button>
		</form>

		<form style="display:inline" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="custom" value="<?= $user ?>">
			<input type="hidden" name="item_name" value="elite_6">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="kt.funky@gmail.com">
			<input type="hidden" name="item_number" value="1">  
			<input type="hidden" name="amount" class="price" value="45">  
			<input type="hidden" name="no_shipping" value="0">  
			<input type="hidden" name="no_note" value="1">  
			<input type="hidden" name="currency_code" value="USD">  
			<input type="hidden" name="lc" value="AU">
			<input type="hidden" name="bn" value="PP-BuyNowBF">  
			<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/six_month.php" />
			<input type="hidden" name="return" value="http://mczone.co?notify=payment">
			<button type="submit" class="btn btn-success">
				<b>$45</b> for 6 months
			</button>
		</form>

		<a href="#" data-dismiss="modal" class="btn">Close</a>
	</div>
</div>

<div class="modal hide fade" id="titan">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>MC Zone Titan Rank</h3>
	</div>
	<div class="modal-body">
		<p>Basics</p>
		<ul>
			<li><b>Aqua [Titan] Prefix:</b> Appears before your username</li>
			<li><b>Instant Credits:</b> 3000c</li>
			<li><b>Reserved Slot:</b> Login to any server that is full</li>
			<li><b>No AFK Kick:</b> You won't be kicked from the lobby for being AFK</li>
			<li><b>Hat:</b> Use <i>/hat</i> in the lobby to wear any block as your helmet</li>
		</ul>
		<p>Kits</p>
		<ul>
			<li><b>Hunger Games:</b> ALL</li>
			<li><b>The Walls:</b> ALL</li>
			<li><b>Hunger Games:</b> ALL</li>
			<li><b>Nexus:</b> ALL</li>
		</ul>
		<p>Pets*</p>
		<ul>
			<li>Baby Pig</li>
			<li>Baby Sheep</li>
			<li>Baby Cow</li>
			<li>Baby Slime</li>
			<li>Baby Chicken</li>
			<li>Baby Magma Cube</li>
			<li>Baby Zombie</li>
			<li>Baby Wolf</li>
			<li>Baby Villager</li>
		</ul>

		* Pets can be spawned in the lobby with <i>/pet spawn</i>
	</div>
	<div class="modal-footer">
		<form style="display:inline" action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick-subscriptions">
			<input type="hidden" name="business" value="kt.funky@gmail.com">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="src" value="1">
			<input type="hidden" name="a3" value="20.00">
			<input type="hidden" name="p3" value="1">
			<input type="hidden" name="t3" value="M">
			<input type="hidden" name="amount1" value="0.00">

			<input type="hidden" name="period1" value="0d">
			<input type="hidden" name="currency_code" value="USD">

			<input type="hidden" name="item_name" value="Titan">
			<input type="hidden" name="custom" id="custom" value="<? echo $user ?>">
			<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/subscription.php" />
			<input type="hidden" name="return" value="http://mczone.co">
			<button type="submit" class="btn btn-primary check">
				<b>$20</b> per month
			</button>
		</form>

		<form style="display:inline" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="custom" value="<?= $user ?>">
			<input type="hidden" name="item_name" value="titan_6">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="kt.funky@gmail.com">
			<input type="hidden" name="item_number" value="1">  
			<input type="hidden" name="amount" class="price" value="80">  
			<input type="hidden" name="no_shipping" value="0">  
			<input type="hidden" name="no_note" value="1">  
			<input type="hidden" name="currency_code" value="USD">  
			<input type="hidden" name="lc" value="AU">
			<input type="hidden" name="bn" value="PP-BuyNowBF">  
			<input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/six_month.php" />
			<input type="hidden" name="return" value="http://mczone.co?notify=payment">
			<button type="submit" class="btn btn-success">
				<b>$80</b> for 6 months
			</button>
		</form>
		<a href="#" data-dismiss="modal" class="btn">Close</a>
	</div>
</div>