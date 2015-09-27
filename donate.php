<div class="page-header">
  <h1>Donate <small>Show your support!</small></h1>
</div>
<h4>Why should I donate?</h4>
<p>
  Donations are what keep MC Zone running. Without asking for donations, we wouldn't have the necessary
  amount of money to pay the monthly server costs and administration fees. This would cause us to charge our users to play 
  on MC Zone. We don't want to do that for many obvious reasons, so we ask for donations. From the lowest, $2.50,
  to a monthly subscription of $20, we accept any donation; Whatever works best for you. Of course, we do not demand donations,
  nor force you to donate, but we do encourage you to donate by giving you benefits on our servers depending on how much you donate.
</p><br />

<h4>What are the options and benefits?</h4>
<p>
  Below are options that provide you with benefits on all MC Zone servers. Note that these options require a monthly subscription. 
  If you wish to donate less, you can get kits for individual servers such as <a href="/games/walls">Walls</a>, 
  <a href="/games/hg">Hunger Games</a>, <a href="/games/nexus">Nexus</a> and <a href="/games/skywars">Sky Wars</a> ($2.50 to $3.50 per kit). 
</p><br />

<h4>Donating Terms</h4>
<p>
  By donating to MC Zone, you understand and agree that all sales are final.  You may not stop or revert the transaction in any way once it has been paid, 
  or credit the server.  We reserve the right to disallow your use of the server, website, or any related content, regardless of purchase.  Any and all transactions are final. 
</p>



<hr />

  <? if ($username == null) { ?>
<form class="no-submit form-inline subscription-search" name="subscr">
  Username: <input type="text" name="username" class="username" value="<?= $_GET['username'] ?>"/>
  <input type="submit" class="btn btn-primary" name="submitter" value="Find Player"/></input>
</form>
<? } ?>

<?= ajax("subscriptions") ?>