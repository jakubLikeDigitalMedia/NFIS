<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 13/12/2013
 * Time: 17:20
 */

session_start();


// check stolen session
//$session = SessionManager::getInstance('user');

if (!isset($_SESSION['user']['userADId'])){
//    //get info from http header
    $userADId = rand(1000, 2000); //testing purposes
//    // check if userADId is in db
   $employee = new Employee();
    $employee->loadEmployee($userADId);
   if ($employee->getProperty('activeDirId') === NULL)
    {
        $_SESSION['user']['userADId'] = $userADId;
//        //header('location: '.PAGES_DIR.'/create_account.php');
        header('location: '.PAGES_DIR.'create_account.php');
    }
    else{
        $_SESSION['user']['userADId'] = $employee->getProperty('activeDirId');
    }
}
else{
    $employee = new Employee($_SESSION['user']['userADId']);
}

?>


<!doctype html>
<html>
<head>
    <title><?= $pageTitle?></title>

    <link rel="stylesheet" type="text/css" href="<?= CSS.'/base.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?= CSS.'/jquery.dynatable.css' ?>">
    <script type="text/javascript" src="<?= JS.'/libs/jquery-1.10.2.min.js'?>"></script>
    <script type="text/javascript" src="<?= JS.'/libs/jquery.dynatable.js'?>"></script>
    <script type="text/javascript" src="<?= JS.'/main.js'?>"></script>

</head>
<body>