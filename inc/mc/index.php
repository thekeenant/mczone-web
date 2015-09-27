<?
$function = $_GET['func'];
if ($function == null) {
  echo 'No function defined';
  exit(0);
}

function getStatus() {
	return query($_GET['server'], $_GET['port'], "status");
}

$result = $function();
echo $result;
