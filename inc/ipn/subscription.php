<?
  include_once 'inc/functions.php'; require_once 'inc/ipn/ipn.class.php';

  connect();
  $verified = false;
  $listener = new IpnListener();

  $listener->use_sandbox = false;

  try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
  } catch (Exception $e) {
    error_log($e->getMessage());
  }
?>

<?
  if ($verified) {
    $user = $_POST['custom'];
    $subs = strtolower($_POST['item_name']);
    $email = $_POST['payer_email'];
    $type = $_POST['txn_type'];

    $credits = 0;

    if ($subs == "vip")
      $credits = 500;
    else if ($subs == "elite")
      $credits = 1250;
    else if ($subs == "titan")
      $credits = 3000;

    if ($type=="subscr_signup") {
      mysql_query("UPDATE players SET subscription='" . $subs . "',subscription_end=DATE_ADD(NOW(), INTERVAL 1 MONTH),subscription_cancelled=0,email='" . $email . "' WHERE username='" . $user . "'");
      mysql_query("UPDATE players SET credits=credits+" . $credits . " WHERE username='" . $user . "'");
    }
    else if ($type=="subscr_payment") {
      mysql_query("UPDATE players SET subscription='" . $subs . "',subscription_end=DATE_ADD(NOW(), INTERVAL 1 MONTH),subscription_cancelled=0,email='" . $email . "' WHERE username='" . $user . "'");
      if ($subs == "vip")
        mysql_query("INSERT INTO donations (amount, date) VALUES ('5.00', now())");
      else if ($subs == "elite")
        mysql_query("INSERT INTO donations (amount, date) VALUES ('10.00', now())");
      else if ($subs == "titan")
        mysql_query("INSERT INTO donations (amount, date) VALUES ('20', now())");
    }
    else if ($type=="subscr_cancel")
      mysql_query("UPDATE players SET subscription_cancelled=1,email='" . $email . "' WHERE username='" . $user . "'");
		else if ($type=="subscr_failed")
      mysql_query("UPDATE players SET subscription_end=now(),subscription_cancelled=1,email='" . $email . "' WHERE username='" . $user . "'");

    $p = "INSERT into pets (owner,type,name,age,name_color,spawned,donator) VALUES ";
    $sheep = "INSERT into pets (owner,type,name,color,age,name_color,spawned,donator) VALUES ";

    if ($subs == "vip") {
      $q = mysql_query("SELECT * FROM players WHERE subscription_cancelled = 1 and subscription='vip' AND username='$user'");
      while ($row = mysql_fetch_array($q)) {
        $u = $row['username'];
        $i++;

        // PIG
        $r = "pig" . $i;
        $s = $p . "('$u','pig','$r','baby','green',0,1)";
        mysql_query($s);
      }
    }
    if ($subs == "elite") {
      $q = mysql_query("SELECT * FROM players WHERE subscription_cancelled = 0 and subscription='elite' AND username='$user'");
      while ($row = mysql_fetch_array($q)) {
        $u = $row['username'];
        $i++;

        // PIG
        $r = "pig" . $i;
        $s = $p . "('$u','pig','$r','baby','green',0,1)";
        mysql_query($s);

        // SHEEP
        $r = "sheep" . rand(1,150);
        $s = $sheep . "('$u','sheep','$r','white','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "cow" . $i;
        $s = $p . "('$u','cow','$r','baby','green',0,1)";
        mysql_query($s);
      }
    }
    if ($subs == "titan") {
      $q = mysql_query("SELECT * FROM players WHERE subscription_cancelled = 0 AND subscription='titan' AND username='$user'");
      while ($row = mysql_fetch_array($q)) {
        $u = $row['username'];
        $i++;

        // PIG
        $r = "pig" . $i;
        $s = $p . "('$u','pig','$r','baby','green',0,1)";
        mysql_query($s);

        // SHEEP
        $r = "sheep" . rand(1,150);
        $s = $sheep . "('$u','sheep','$r','white','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "cow" . $i;
        $s = $p . "('$u','cow','$r','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "slime" . $i;
        $s = $p . "('$u','slime','$r','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "chicken" . $i;
        $s = $p . "('$u','chicken','$r','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "slime" . $i;
        $s = $p . "('$u','slime','$r','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "magma_cube" . $i;
        $s = $p . "('$u','magma_cube','$r','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "zombie" . $i;
        $s = $p . "('$u','zombie','$r','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "wolf" . $i;
        $s = $p . "('$u','wolf','$r','baby','green',0,1)";
        mysql_query($s);

        // COW
        $r = "villager" . $i;
        $s = $p . "('$u','villager','$r','baby','green',0,1)";
        mysql_query($s);
      }
    }


  }
?>
