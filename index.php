<?php
require('src/config.php');
require('src/tableDataGateway.php');
require('src/Error.php');
require('src/Validator.php');
require('src/Pager.php');
require('src/LinkHelper.php');
require('src/Notify.php');

$recordsOnPage = 50;

$conf = new Config;
$tdg = new TableDataGateway;
$tdg->setConfig($conf->servername, $conf->username, $conf->password, $conf->dbname, $conf->errmode);
$pager = new Pager;
$linkster = new LinkHelper;

$page = isset($_GET[page]) ? htmlspecialchars(strval(abs($_GET[page]))) : 1;
$search = isset($_GET[search]) ? htmlspecialchars(strval($_GET[search])) : '';
$order = isset($_GET[order]) ? htmlspecialchars(strval($_GET[order])) : 'egepoints';
$orderdir = isset($_GET[orderdir]) ? htmlspecialchars(strval($_GET[orderdir])) : 'desc';
$url = $_SERVER[REQUEST_URI];

if ($page > $pager->getLastPageNum($recordsOnPage, $tdg->getCountRecords($search))) {
    header("Location: {$linkster->createLink('page', 1, $url)}");
}

if (!in_array($order,['name','surname','sex','groupnum','email','egepoints','birthyear','local'])) {
    header("Location: {$linkster->createLink('order', null, $url)}");
}

if (!in_array($orderdir,['asc','desc'])) {
    header("Location: {$linkster->createLink('orderdir', null, $url)}");
}

if ($_COOKIE[pass]) {
    foreach ($tdg->getHashEmails() as $hash) {
        if (password_verify($_COOKIE[pass], $hash[cookpass])) {
            session_start();
            foreach ($tdg->getStudents(1, 1, $hash[email], 'name', 'asc')[0] as $key => $value) {
                $_SESSION[$key] = $value;    
            }
            break;
        }
    }
}

$students = $tdg->getStudents($recordsOnPage, $page, $search, $order, $orderdir);
$linkpage = $pager->generatePageList($recordsOnPage, $tdg->getCountRecords($search), $page);
$headers = $tdg->getHeaders();

include('header.html');
include('search.html');
include('table.html');
include('linkpage.html');
include('footer.html');
