<?php

namespace chupacabra007\networking;

class StreamRequestHandler extends BaseRequestHandler
{
    public function handle() {}
    
    public function read()
    {
        return socket_read($this->request, 1024, PHP_NORMAL_READ); 
    }
    
    public function write($data)
    {
        socket_write($this->request, $data); 
    }

}