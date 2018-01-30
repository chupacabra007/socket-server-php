<?php

/*require '../src/vendor/autoload.php';

use chupacabra007\networking\TcpServer;
use chupacabra007\networking\UdpServer;

$tcp = new TcpServer('127.0.0.1', 21665, 'ParenthesesTcpChecker');

$tcp->serve_forever();
*/
$server_host = '127.0.0.1';
$server_port = 21665;
$poll_interval = 0.5;
$socket = socket_create(AF_INET, SOCK_DGRAM, 0);
socket_bind($socket, $server_host, $server_port);

$clients = [$socket];
while(true) {
    $read = $clients;
    $write = [];
    $except = [];
            
    if (socket_select($read, $write, $except, $poll_interval) < 1){
        continue;
    }
            
    if (in_array($socket, $read)) {
        echo "Client submitted request!\n";
        //request parsing                   
    }                
}
        