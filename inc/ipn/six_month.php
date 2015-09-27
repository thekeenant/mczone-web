<? include_once '../functions.php';include_once 'ipn.class.php'; ?>
<? connect() ?>

<?php
  $listener = new IpnListener();

  $listener->use_sandbox = false;

  try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
  } catch (Exception $e) {
    error_log($e->getMessage());
  }

  if ($verified) {
    $user = $_POST['custom'];
    $sub = $_POST['item_name'];
    $email = $_POST['payer_email'];

    if ($sub != "vip_6" && $sub != "elite_6" && $sub != "titan_6")
      exit();
    
    $s = "vip";
    $donation = "20.00";

    if ($sub == "elite_6") {
      $s = "elite";
      $donation = "45.00";
    }
    else if ($sub == "titan_6") {
      $s = "titan";
      $donation = "100.00";
    }
    $subs = $s;

    mysql_query("UPDATE players SET subscription='" . $s . "',subscription_end=DATE_ADD(NOW(), INTERVAL 6 MONTH),subscription_cancelled=1,email='" . $email . "' WHERE username='" . $user . "'");
    mysql_query("INSERT INTO donations (amount, date) VALUES ('" . $donation . "', now())");

    $p = "INSERT into pets (owner,type,name,age,name_color,spawned,donator) VALUES ";
    $sheep = "INSERT into pets (owner,type,name,color,age,name_color,spawned,donator) VALUES ";

    if ($subs == "vip") {
      $q = mysql_query("SELECT * FROM players WHERE subscription='vip' AND username='$user'");
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
      $q = mysql_query("SELECT * FROM players WHERE subscription='elite' AND username='$user'");
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
      $q = mysql_query("SELECT * FROM players WHERE subscription='titan' AND username='$user'");
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

  } else {
    header('Location: http://mczone.co');
  }
?>
