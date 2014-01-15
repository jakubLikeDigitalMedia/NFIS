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
$groupName = $_POST['new_group'];
if(!$result){
    $_SESSION['user']['inputs']['current_grp'] = $_POST;
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?group_added=true&group_name=$groupName");
}else{
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?group_added=false&group_name=$groupName");
}
