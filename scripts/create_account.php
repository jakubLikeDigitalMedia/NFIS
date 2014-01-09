<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 17:05
 */

include_once '../core_incs.php';

session_start();
//var_dump($_POST);
$employee = new Employee();
$result = $employee->createAccount($_POST);
//die(var_dump($result));
if (!empty($result['current_empl']) OR (!empty($result['prev_empl']))){
    $_SESSION['user']['errors']['current_empl'] = $result['current_empl'];
    $_SESSION['user']['inputs']['current_empl'] = $_POST;
    $_SESSION['user']['errors']['prev_empl'] = $result['prev_empl'];
    $_SESSION['user']['inputs']['prev_empl'] = $result['prev_empl_vals'];
    //die(var_dump($_SESSION['user']));
    header('location: ../intranet/create_account.php');
}
elseif(is_bool($result) && $result === TRUE){
    header('location: ../intranet/acount_created.php');

}
