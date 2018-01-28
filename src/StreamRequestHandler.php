<?php

namespace chupacabra007\networking;

class StreamRequestHandler extends BaseRequestHandler
{
    private $connection;
    
    public function handle() {}
    
    public function setup()
    {
        $this->connection = $this->request;
    }
    
    public function read()
    {
        return socket_read($this->connection, 1024, PHP_NORMAL_READ); 
    }
    
    public function write($data)
    {
        socket_write($this->connection, $data); 
    }

}