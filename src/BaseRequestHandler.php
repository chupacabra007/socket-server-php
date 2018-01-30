<?php

namespace chupacabra007\networking;

abstract class BaseRequestHandler
{
    protected $request;
    protected $client_ip;
    protected $client_port;
    protected $buf;
    
    public function __construct($request, $client_ip, $client_port, $buf)
    {
        $this->request = $request;
        $this->client_ip = $client_ip;
        $this->client_port = $client_port;
        $this->buf = $buf;
        $this->handle();
    }
    
    abstract public function handle();   
}