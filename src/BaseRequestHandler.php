<?php

namespace chupacabra007\networking;

abstract class BaseRequestHandler
{
    protected $request;
    
    public function __construct($request)
    {
        $this->request = $request;
        $this->setup();
        $this->handle();
    }
    
    abstract public function setup();  
    abstract public function handle();   
}