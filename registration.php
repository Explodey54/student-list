<?php

require('src/config.php');
require('src/tableDataGateway.php');
require('src/Error.php');
require('src/Validator.php');
require('src/PasswordGenerate.php');
require('src/Notify.php');

$conf = new Config;
$tdg = new TableDataGateway;
$tdg->setConfig($conf->servername, $conf->username, $conf->password, $conf->dbname, $conf->errmode);
$pass = new PasswordGenerate;
$valid = new Validator;
$notify = new Notify;
$notifyArr = $notify->messages;

$error = array();
$notifyVar = isset($notifyArr[$_GET[notify]]) ? strval($_GET[notify]) : null;

$fields = $tdg->getFields();

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

if (!(empty($_POST))) {
    foreach ($fields as $value) {
        $error[$value[name]]=$valid->checkRouter($value[checkErr], $value[value]);
    }
}

if (empty(implode('',$error)) && !(empty($_POST))) {
    if (empty($_SESSION)) {
        $passGen = $pass->generateCookiePassword();
        $fields[checkErr]= array( value => $passGen[hash] );
        setcookie("pass", $passGen[pass], strtotime( '+10 years' ));
        $tdg->setStudent($fields);
        unset($fields[checkErr]);
        header("Location: http://{$_SERVER[HTTP_HOST]}/{$_SERVER[PHP_SELF]}?notify=registred");
    } else {
        $tdg->updateStudent($fields);
        header("Location: http://{$_SERVER[HTTP_HOST]}/{$_SERVER[PHP_SELF]}?notify=updated");
    }
}


include('templates/header.html');
if (empty($notifyVar)) {
    include('templates/form.html');
} else {
    include('templates/notify.html');
}
include('templates/footer.html');