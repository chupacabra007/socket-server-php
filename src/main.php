<?php


error_reporting(E_ALL);

require 'vendor/autoload.php';

use chupacabra007\networking\TcpServer;
use chupacabra007\networking\StreamRequestHandler;

class EchoHandler extends StreamRequestHandler
{
    public function handle()
    {
    	   while (true)
         {
             $data = trim($this->read());
             if ($this->nonstop($data))
             {
                 $this->write($data . "\n"); 
                 continue;            
             }
             break;
         }
         
    }
    
    public function nonstop($data)
    {
        return $data != 'exit';    
    }
}

$tcp = new TcpServer("127.0.0.1", 21632, 'EchoHandler');

$tcp->serve_forever();




