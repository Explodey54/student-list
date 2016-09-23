<?php 

class PasswordGenerate {
    
    private $length = 20;
    
    private function generateRandString () {
        $string = substr(str_shuffle(MD5(microtime())), 0, $this->length);
        return $string;
    }
    
    public function generateCookiePassword () {
        $passArray = array();
        $randString = $this->generateRandString();
        $passArray[pass] = $randString;
        $passArray[hash] = password_hash($randString, PASSWORD_DEFAULT);
        return $passArray;
    }
}