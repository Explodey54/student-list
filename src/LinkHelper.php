<?php 

class LinkHelper {
    
    public function createLink ($query, $value, $url) {
        $link = $url;
        $preg = "/{$query}=(\w*)/iu";
        if (mb_substr($link, 1, 1) != '?') { $link = '/?'; }
        
        
            
        if (preg_match($preg, $link)) {
            $link = preg_replace($preg, "{$query}={$value}", $link);
        } elseif (empty(mb_substr($link, 3, 1))) {
            $link = $link."{$query}={$value}";
        } else {
            $link = $link."&{$query}={$value}";
        }
        
        if (empty($value)) {
            $link = preg_replace("/&?{$query}=(\w*)/iu", "", $link);
        }
        return $link;
    }   
}