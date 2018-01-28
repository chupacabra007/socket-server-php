<?php

class ForkingMixIn
{
    public function process_request()
    {
        $this->finish_request($request);
        $this->shutdown_request($request);    
    }
}