<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 17:05
 */

include_once '../core_incs.php';

session_start();

die(var_dump($_POST));

$employee = new Employee();
$result = $employee->createAccount($_POST);
var_dump($result);
if (!empty($result) && is_array($result)){
    $_SESSION['user']['input_errors'] = $result;
    $_SESSION['user']['inputs'] = $_POST;
    header('location: ../intranet/create_account.php');
}
elseif(is_bool($result) && $result === TRUE){
    echo 'Inserted';

}
