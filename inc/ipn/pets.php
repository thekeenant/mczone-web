<? include_once '../functions.php'; include_once 'ipn.class.php'; ?>
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
    $username = $_POST['custom'];
    $pet = $_POST['item_name'];
    $email = $_POST['payer_email'];
    $name = $pet . rand(1,50);
    mysql_query("INSERT INTO pets (owner,type,name,color,age,name_color,spawned) VALUES ('$username','$pet','$name','white','baby','green',0)");

    $cost = $_POST['mc_gross'];
    mysql_query("INSERT INTO donations (amount, date) VALUES ('$cost', now())");
    mysql_query("UPDATE players SET email='" . $email . "' WHERE username='" . $username . "'");
  } else {
    header('Location: http://mczone.co');
  }
?>
