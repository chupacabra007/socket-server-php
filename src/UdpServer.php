<?php

namespace chupacabra007\networking;

class UdpServer extends TcpServer 
{
    use ForkingMixIn;
        
    private $socket_type = SOCK_DGRAM;
    private $address_family = AF_INET;    
    private $allow_reuse_address = false;
    private $max_packet_size = 8192;
    
    public function server_activate() { }
    
    public function get_request(&$request, &$client_ip, &$client_port, &$buf)
    {
        socket_recvfrom($this->socket, $buf, $this->max_packet_size, 0, $client_ip, $client_port);
    }
    
    public function shutdown_request($request) { }
    
    public function close_request($request) { }
    
}