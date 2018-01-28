<?php

namespace chupacabra007\networking;


class TcpServer extends BaseServer 
{
    use ForkingMixIn;
        
    private $socket;
    private $socket_type = SOCK_STREAM;
    private $address_family = AF_INET;    
    private $request_queue_size = 5;
    private $allow_reuse_address = false;

    public function __construct($server_host, $server_port, $RequestHandlerClass, bool $bind_and_activate = true)
    {
        parent::__construct($server_host, $server_port, $RequestHandlerClass); 
        $this->socket = socket_create($this->address_family, $this->socket_type, 0);
        
        if ($bind_and_activate)
        {
            $this->server_bind();
            $this->server_activate();       
        }
    }
    
    public function server_bind()
    {
        if ($this->allow_reuse_address)
            socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
        socket_bind($this->socket, $this->server_host, $this->server_port);
        socket_getsockname($this->socket, $this->server_host, $this->server_port);
    }  
    
    public function fileno()
    {
        return $this->socket;    
    }
    
    public function server_activate()
    {
        socket_listen($this->socket, $this->request_queue_size);
    }
    
    public function get_request()
    {
        return socket_accept($this->socket);    
    }
    
    public function shutdown_request($request)
    {
        socket_shutdown($request, STREAM_SHUT_WR);
        $this->close_request($request);
    }
    
    public function close_request($request)
    {
        socket_close($request);    
    }
    
    public function server_close()
    {
        socket_close($this->socket);    
    }
}








