<? $title = "Shop"; connect() ?>

<div class="page-header">
  <h1>Shop</h1>
</div>

<h4>What are the options and benefits?</h4>
<p>
  Below are options that provide you with benefits on all MC Zone servers. Note that these options require a monthly subscription. 
  If you wish to donate less, you can get kits for individual servers such as <a href="/games/walls">Walls</a>, 
  <a href="/games/hg">Hunger Games</a>, <a href="/games/nexus">Nexus</a> and <a href="/games/skywars">Sky Wars</a> ($2.50 to $3.50 per kit). 
</p><br />


<h4>Terms of Service</h4>
<p>
	By purchasing from MC Zone, you agree to Section 9 of the MC Zone <a href="/terms">Terms of Service</a>.
</p>

<hr />

  <? if ($username == null) { ?>
<form class="no-submit form-inline subscription-search" name="subscr">
  Username: <input type="text" name="username" class="username" value="<?= $_GET['username'] ?>"/>
  <input type="submit" class="btn btn-primary" name="submitter" value="Find Player"/></input>
</form>
<? } ?>

<?= ajax("subscriptions") ?>