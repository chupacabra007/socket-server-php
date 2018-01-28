<?php


error_reporting(E_ALL);

/*
require 'vendor/autoload.php';

use chupacabra007\networking\TcpServer;
use chupacabra007\networking\StreamRequestHandler;

class EchoHandler extends StreamRequestHandler
{
    //Simple echo handler
    public function handle()
    {
         $data = $this->read();
         $this->write($data . "\n");
    }
}

$tcp = new TcpServer("127.0.0.1", 21624, 'EchoHandler');

$tcp->serve_forever();

*/

$host = '127.0.0.1';
$port = 21626;

$socket = socket_create(AF_INET, SOCK_STREAM, 0);
socket_bind($socket, $host, $port);
socket_getsockname($socket, $host, $port);
socket_listen($socket, 5);

$clients = [$socket];
while(true)
{
    $read = $clients;
    $write = [];
    $except = [];
    if (socket_select($read, $write, $except, 0.5) < 1){
        continue;
    }
    if (in_array($socket, $read)) {
        handle_request($socket);                       
    }                
}

function handle_request($socket)
{
    $client = socket_accept($socket); 
    $data = socket_read($client, 1024, PHP_NORMAL_READ); 
    socket_write($client, $data . "\n"); 
}




