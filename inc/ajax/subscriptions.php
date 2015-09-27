<? $user = $_GET['username'] ?>
<? if ($username != null) { $user = $username; } ?>
<? if ($user == null) { ?>

<b>
  Enter in your username above to view the subscription options
</b>
<? exit() ?>

<? } ?>

<?
  connect();
  $playerquery = mysql_query("SELECT * FROM players WHERE username='$user'");
  while ($row = mysql_fetch_array($playerquery)) {
    $user = $row['username'];
    $subscription = strtolower($row['subscription']);
    $end = $row['subscription_end'];
    $cancelled = $row['subscription_cancelled'];
    $banned = false;
    if ($row['warns']==5)
      $banned = true;
  }

  if (mysql_numrows($playerquery)==0) { ?>
    <div class="row">
      <div class="span7">
        <h4>Player not found!</h4>
      </div>
    </div>
  <? } else { ?>


<div class="row">
  <div class="span11">
    <div class="row">
      <div class="span1">
        <?= avatar($user,84) ?>
      </div>
      <div class="span9">
        <h4>Welcome, <? echo $user ?></h4>
        <? if ($subscription != null) { ?>
          <p>
            <? if ($cancelled==0) { ?>
              You have a <b><?= strtoupper($subscription) ?></b> subscription that will renew on <b><? echo strftime('%D', strtotime($end)); ?></b>! 
              <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=kt.funky@gmail.com" class="btn btn-danger btn-mini">Cancel Renewal</a>
            <? } else { ?>
              You have a <b><?= strtoupper($subscription) ?></b> subscription that will end on <b><? echo strftime('%D', strtotime($end)); ?></b>
              <a href="#" class="btn btn-danger btn-mini disabled">Payment is cancelled</a>
            <? } ?>
          </p>
        <? } else { ?>
          <p>You have no upgrades at this time.</p>
        <? } ?>
      </div>
    </div>
  </div>
</div>
<div class="row subscriptions">
  <div id="vip" class="span4">
    <h3>VIP</h3>
    <p><b>All Servers:</b></p>
    <ul>
      <li>Gold name or prefix</li>
      <li>Reserved server slot</li>
    </ul>
    <p><b>Walls:</b></p>
    <ul>
      <li>Team of choice</li>
    </ul>
    <p><b>Sky Wars:</b></p>
    <ul>
      <li>Team of choice</li>
    </ul>
    <p><b>Hunger Games:</b></p>
    <ul>
      <li>Kits: Enchanter, Heavy, Healer</li>
    </ul>
    <p><b>Nexus MC:</b></p>
    <ul>
      <li>Team of choice</li>
    </ul>
    <hr />
    <form action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
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
      <center>
        <button type="submit" class="btn btn-warning check" <? if (($subscription != null) && $cancelled==0) { ?>disabled="disabled"<? } ?>>
          <b>1 month</b> for <b>$5</b> (recurring)
        </button>
      </center>
    </form>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="custom" value="<?= $user ?>">
      <input type="hidden" name="item_name" class="item_name" value="vip_6">
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
      <center><button type="submit" <? if (($subscription != null) && $cancelled==0) { ?>disabled="disabled"<? } ?> class="btn btn-warning check item_price"><b>6 month</b> for <b>$20</b> (33% off)</button></center>
    </form>
  </div>

  <div id="elite" class="span4">
    <h3>Elite</h3>
    <p><b>All Servers:</b></p>
    <ul>
      <li>Green name or prefix</li>
      <li>Reserved server slot</li>
    </ul>
    <p><b>Walls:</b></p>
    <ul>
      <li>Team of choice</li>
      <li>Kits: Archer, Warrior, Beastmaster</li>
    </ul>
    <p><b>Sky Wars:</b></p>
    <ul>
      <li>Team of choice</li>
    </ul>
    <p><b>Hunger Games:</b></p>
    <ul>
      <li>Kits: Enchanter, Heavy, Healer, Pyro, Chemist</li>
    </ul>
    <p><b>Nexus MC:</b></p>
    <ul>
      <li>Team of choice</li>
    </ul>
    <hr />
    <form action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
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
      <center>
        <button type="submit" class="btn btn-success check" <? if (($subscription != null) && $cancelled==0) { ?>disabled="disabled"<? } ?>>
          <b>1 month</b> for <b>$10</b> (recurring)
        </button>
      </center>
    </form>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="custom" value="<?= $user ?>">
      <input type="hidden" name="item_name" class="item_name" value="elite_6">
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
      <center><button type="submit" <? if (($subscription != null) && $cancelled==0) { ?>disabled="disabled"<? } ?> class="btn btn-success check item_price"><b>6 month</b> for <b>$45</b> (25% off)</button></center>
    </form>
  </div>

  <div id="titan" class="span4">
    <h3>Titan</h3>
    <p><b>All Servers:</b></p>
    <ul>
      <li>Aqua name or prefix</li>
      <li>Reserved server slot</li>
    </ul>
    <p><b>Walls:</b></p>
    <ul>
      <li>Team of choice</li>
      <li>Kits: ALL</li>
    </ul>
    <p><b>Sky Wars:</b></p>
    <ul>
      <li>Team of choice</li>
      <li>Kits: ALL</li>
    </ul>
    <p><b>Hunger Games:</b></p>
    <ul>
      <li>Kits: ALL</li>
    </ul>
    <p><b>Nexus MC:</b></p>
    <ul>
      <li>Team of choice</li>
      <li>Kits: ALL</li>
    </ul>
    <hr />
    <form action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
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
      <center>
        <button type="submit" class="btn btn-primary check" <? if (($subscription != null) && $cancelled==0) { ?>disabled="disabled"<? } ?>>
          <b>1 month</b> for <b>$20</b> (recurring)
        </button>
      </center>
    </form>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
      <input type="hidden" name="custom" value="<?= $user ?>">
      <input type="hidden" name="item_name" class="item_name" value="titan_6">
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
      <center><button type="submit" <? if (($subscription != null) && $cancelled==0) { ?>disabled="disabled"<? } ?> class="btn btn-primary check item_price"><b>6 month</b> for <b>$80</b> (33% off)</button></center>
    </form>
  </div>
</div>

<? } ?>