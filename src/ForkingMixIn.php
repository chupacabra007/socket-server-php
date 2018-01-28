<?php

namespace chupacabra007\networking;


trait ForkingMixIn
{
    private $timeout = 300;
    private $active_children = null;
    private $max_children = 40;
    
    
    public function collect_children()
    {
        if ($this->active_children === null)
            return;
            
        
        while (count($this->active_children) >= $this->$max_children)
        {
            $pid = pcntl_waitpid(-1, $status, 0);
            if ($pid == -1)
            {
                $this->$active_children = null;
                break;           
            } 
            elseif (($key = array_search($pid, $this->active_children)) !== false) {
                unset($this->active_children[$key]);
            }      
        }
        
        
        foreach ($this->active_children as $key => $pid)
        {
            $pid = pcntl_waitpid($pid, $status, WNOHANG);
            
            if ($pid == -1)
            {
                $this->$active_children = null;
                break;
            }
            elseif ($pid && ($key = array_search($pid, $this->active_children)) !== false) {
                unset($this->active_children[$key]);                      
            }   
        } 
        
    }
    
	
    public function process_request($request)
    {
    	  $this->collect_children();
    	  
    	  $pid = pcntl_fork();

        if ($pid == -1)
        {
            exit(1);        
        } 
        elseif ($pid)
        {
            if ($this->active_children === null)
                $this->active_children = [];
            $this->active_children[] = $pid;
            $this->close_request($request);
            return;
        }
        else 
        {
        	   $this->finish_request($request);
            $this->shutdown_request($request);
            exit(0);
        }    	  
    	    	      
    }
    

}