<? $title = "NexusMC"; connect() ?>

<header class="subhead">
  <div class="container">
    <h1>Nexus MC</h1>
    <p class="lead">
      Play team deathmatch on various custom maps with 50 other players!
    </p>
    <a class="btn btn-primary btn-large" data-toggle="modal" href="#play" >Play Now »</a>
  </div>
</header>
<br />

<h2>Buy Kits</h2>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" class="form-inline fancy-kits-form pull-right" style="margin-top:15px;">
  <div class="input-prepend">
    <span class="add-on">Username: </span>
    <input type="text" name="custom" id="custom" autocomplete="off" class="span2 username" style="width: 120px;">
  </div>
  <input type="hidden" name="item_name" class="item_name" value="">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="business" value="kt.funky@gmail.com">
  <input type="hidden" name="item_number" value="1">  
  <input type="hidden" name="amount" class="price" value="0">  
  <input type="hidden" name="no_shipping" value="0">  
  <input type="hidden" name="no_note" value="1">  
  <input type="hidden" name="currency_code" value="USD">  
  <input type="hidden" name="lc" value="AU">
  <input type="hidden" name="bn" value="PP-BuyNowBF">  
  <input type="hidden" name="notify_url" value="http://mczone.co/inc/ipn/nexus/multiple.php" />
  <input type="hidden" name="return" value="http://mczone.co?notify=payment">
  <button type="submit" disabled="disabled" class="btn btn-success check item_price">Purchase Cart ($0.00)</button>
</form>
<table class="table ajaxify-simple">
  <thead>
    <th>Kit Name</th>
    <th>About</th>
    <th>Price</th>
    <th>Cart</th>
  </thead>
  <?
  $kitsquery = mysql_query("SELECT * FROM nexus_packages ORDER BY new,title");
  while ($row = mysql_fetch_array($kitsquery)) {
    $t = ucwords($row['title']);
    $desc = ucfirst($row['details']);
    $desc = str_replace('|','<br />&bull; ',$desc);
    $desc = '&bull; ' . $desc;
    $new = $row['new']==1 ? "background-color: #CAEECF" : "";
    ?>
    <tr style="<? echo $new ?>">
      <td><b><?= $t ?></b></h4>
        <td><?= $desc ?></td>
        <td>$3.50</td>
        <td><input type="checkbox" class="checkbox" name="<?= strtolower($t) ?>"></td>
      </tr>
      <? } ?>
    </table>

<script type="text/javascript">
var kit_price = 3.50;
</script>
