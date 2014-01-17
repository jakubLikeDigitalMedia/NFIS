<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 14/01/2014
 * Time: 18:41
 */

require('../../core_incs.php');

session_start();

//creating a new group
$group = new Group();
$result = $group->createGroup($_POST);

die(var_dump($result));

unset($_SESSION['new_group']);
$_SESSION['group']['inputs'] = $_POST;
//die(var_dump($_SESSION['new_group']));
if(!empty($result)){
    $_SESSION['new_group']['error'] = $result;
    header("Location: " . $_SERVER['HTTP_REFERER']);
}else{
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
