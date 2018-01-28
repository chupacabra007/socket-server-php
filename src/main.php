<?php


error_reporting(E_ALL);

/*require 'vendor/autoload.php';

use chupacabra007\networking\TcpServer;
use chupacabra007\networking\StreamRequestHandler;

class TestHandler extends StreamRequestHandler
{
    //Simple echo handler
    public function handle()
    {
         $data = $this->read();
         $this->write($data . "\n");
    }
}

$tcp = new TcpServer("127.0.0.1", 21614, 'TestHandler');

$tcp->serve_forever();

*/

/*
$child_processes = array();

$pid = pcntl_fork();
if ($pid == -1) {
   exit;
} elseif ($pid === 0) {
	$pid = getmypid();
   echo "Child process\n";
   exit;
} else {
   $child_processes[$pid] = true;
   echo "Parent process\n";
}


*/

phpinfo();






