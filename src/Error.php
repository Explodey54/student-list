<?php 

class Error {
    
    public function __toString()
    {
        return $this->errordescr;
    }
    
    public $errordescr = '';

}