<?php

namespace chupacabra007\networking;

use chupacabra007\parenthesis\Checker;

trait ParenthesesChecker
{
    public function handle()
    {
    	   $this->write("***Please type parentheses and hit Enter (or type \"exit\")***\n"); 
    	   
    	   while (true) {
             $data = trim($this->read());
             
             if ($this->exit($data)) {
                 break;
             }
             
             if ($data == "") {
                 continue;
             }
             
             try {             
                 if (Checker::check($data)) {
                     $message = "Parentheses are balanced!\n";             	  
                 } else {
                     $message = "Parentheses are not balanced!\n"; 
                 }             
             } catch (\RuntimeException $e) {
                 $message = $e->getMessage() . "\n";          
             }
             
             $this->write($message); 
         }         
    }
    
    public function exit($data)
    {
        return strpos($data, "exit") !== false;    
    }
}