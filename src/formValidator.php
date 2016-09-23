<?php
class Validator {
    
    public function checkRouter($checktype, $var) {
        if (empty($var)) {
            $error = new Error;
            $error->errordescr = "Поле не должно быть пустым!";
        } elseif (empty($checktype)) {
            return;
        } else {
            $error = $this->$checktype($var);
        }
            return $error;
    }
    
    private function checkLong($var) {
        $minsym = 3;
        $maxsym = 25;
        if (mb_strlen($var) < $minsym || mb_strlen($var) > $maxsym) {
            $error = new Error;
            $error->errordescr = "Поле должно содержать от {$minsym} до {$maxsym} символов.";
        }
        return $error;    
    }
    
    private function checkLong2to5 ($var) {
        $minsym = 2;
        $maxsym = 5;
        if (mb_strlen($var) < $minsym || mb_strlen($var) > $maxsym) {
            $error = new Error;
            $error->errordescr = "Поле должно содержать от {$minsym} до {$maxsym} символов.";
        }
        return $error;
    }
        
    private function checkEmail ($var) {
        $regexp = '/(\S+)@(\S+)\.(ru|org|com)/i';
        if (!preg_match($regexp, $var)) {
            $error = new Error;
            $test1 = $_SESSION[email];
            $error->errordescr = "[eq";
            return $error;
        }
        $tdg = new TableDataGateway;
        if (($tdg->countEmail($var, '2', '3')) > 0) {
            $error = new Error;
            $error->errordescr = "Такой email уже занят.";
        }
        return $error;
    }
    
    private function checkPoints ($var) {
        if (!is_numeric($var)) {
            $error = new Error;
            $error->errordescr = "Поле должно содержать число.";
            return $error;
        }
        if ($var < 20 || $var > 300) {
            $error = new Error;
            $error->errordescr = "Некорректное число баллов.";
        }
        return $error;
    }
    
    private function checkYear ($var) {
        if (!is_numeric($var)) {
            $error = new Error;
            $error->errordescr = "Поле должно содержать число.";
            return $error;
        }
        if ($var < 1960 || $var > 2012) {
            $error = new Error;
            $error->errordescr = "Некорректный год.";
        }
        return $error;
    }
    
}