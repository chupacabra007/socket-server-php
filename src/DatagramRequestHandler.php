<?php

namespace chupacabra007\networking;

class DatagramRequestHandler extends BaseRequestHandler
{
    public function handle() {}
    
    public function read()
    {
        return $this->buf;
    }
    
    public function write($data)
    {
    	  $len = strlen($data);
        socket_sendto($this->request, $data, $len, 0, $this->client_ip, $this->client_port);
    }

}