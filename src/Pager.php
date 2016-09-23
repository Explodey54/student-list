<?php

class Pager {
    
    public function generatePageList($recordsPerPage, $allRecords, $currentPage) {
        $allPages = ceil($allRecords/$recordsPerPage);
        $pageNearArray = array();
        if ($currentPage == 1) { $currentPage++; }
        if ($currentPage == $allPages) { $currentPage = $allPages - 1; }
        if ($allPages > 7) {
            for ($i=-1; $i<=1; $i++) {
                $pageNearArray[] = $currentPage + $i;
            }
        } else {
            for ($i=1; $i<=$allPages; $i++) {
                $pageNearArray[] = $i;
            }
        }
        $pageArray = array();
        $z = 0;
        for ($i=1; $i<=$allPages; $i++) {
            if ($i == 1 || $i == $allPages || in_array($i, $pageNearArray)) {
                $pageArray[] = $i;
                $z = 0;
            } elseif ($z == 0) {
                $pageArray[] = '...'; 
                $z = 1;
            }
        }
        return $pageArray;
    }
    
    public function getLastPageNum($recordsPerPage, $allRecords) {
        if ($allRecords/$recordsPerPage == 0) {
            return 1;
        } else {
            return ceil($allRecords/$recordsPerPage);
        }
    }
}