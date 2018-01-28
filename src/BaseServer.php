<?php

namespace chupacabra007\networking;

abstract class BaseServer 
{
    protected $server_host;
    protected $server_port;
    private $RequestHandlerClass;
    private $shutdown_request = false;
    
        
    public function __construct($server_host, $server_port, $RequestHandlerClass)
    {
        $this->server_host = $server_host;
        $this->server_port = $server_port;
        $this->RequestHandlerClass = $RequestHandlerClass;
    }
    
    
    abstract public function server_activate();
    
    
    public function serve_forever($poll_interval = 0.5)
    {
        $socket = $this->fileno();
        $clients = [$socket];
        while(!$this->shutdown_request)
        {
            $read = $clients;
            $write = [];
            $except = [];
            
            if (socket_select($read, $write, $except, $poll_interval) < 1){
                continue;
            }
            
            if (in_array($socket, $read)) {
                $this->handle_request();                       
            }                
        }
    }
    
    
    public function shutdown()
    {
        $this->shutdown_request = true; 
    }
    
    
    public function handle_request()
    {
        $request = $this->get_request();
        
        if ($this->verify_request($request))
        {
            $this->process_request($request);        
        } 
        else 
        {
            $this->shutdown_request($request);        
        }        
    }  
    
    
    public function verify_request($request)
    {
        return true;    
    }
    
    
    public function process_request($request)
    {
        $this->finish_request($request);
        $this->shutdown_request($request);
    }
    
    
    public function finish_request($request)
    {
        $HandlerClass = $this->RequestHandlerClass;
        new $HandlerClass($request);
    }
    
    public function shutdown_request($request)
    {
        $this->close_request($request);
    }
    
    
    abstract public function close_request($request);
    
    
    abstract public function server_close();
    
}




























