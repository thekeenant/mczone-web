<?php

namespace status;

class Stats {


  public static function retrieve( \status\Server $server ) {

    $socket = stream_socket_client(sprintf('tcp://%s:%u', $server->getHostname(), $server->getPort()), $errno, $errstr, 1);
    
    if (!$socket) {
      $stats->online = false;
      return $stats;
    }

    fwrite($socket, "\xfe\x01");
    stream_set_timeout($socket, 4);
    $data = fread($socket, 1024);
    fclose($socket);

    $stats = new \stdClass;

    // Is this a disconnect with the ping?
    if($data == false AND substr($data, 0, 1) != "\xFF") {
      $stats->online = false;
      return $stats;
    }

    $data = substr($data, 9);
    $data = mb_convert_encoding($data, 'auto', 'UCS-2');
    $data = explode("\x00", $data);

    $stats->online = true;
    list($stats->protocol_version, $stats->game_version, $stats->motd, $stats->online_players, $stats->max_players) = $data;

    return $stats;

  }


}