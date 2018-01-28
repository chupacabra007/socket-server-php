<?php


error_reporting(E_ALL);

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

$tcp = new TcpServer("127.0.0.1", 21623, 'EchoHandler');

$tcp->serve_forever();






