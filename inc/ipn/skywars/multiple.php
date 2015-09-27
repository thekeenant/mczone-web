<? include_once '../../functions.php';include_once '../ipn.class.php'; ?>
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
    $kits = split(",",$_POST['item_name']);
    $email = $_POST['payer_email'];
    foreach ($kits as $kit) {
      if ($kit == "" || $kit == " ")
        continue;
      
      mysql_query("INSERT INTO skywars_donations (username,kit) VALUES ('" . $username . "', '" . $kit . "')");
      mysql_query("INSERT INTO donations (amount, date) VALUES ('2.50', now())");
    }

    mysql_query("UPDATE players SET email='" . $email . "' WHERE username='" . $username . "'");
  } else {
    header('Location: http://mczone.co');
  }
?>
