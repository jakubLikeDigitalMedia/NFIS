<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 17:05
 */

include_once '../core_incs.php';

session_start();


 var_dump($_POST);
$employee = new Employee();
$result = $employee->createAccount($_POST);
//die(var_dump($result));
if (!empty($result['errors']) && is_array($result['errors'])){
    $_SESSION['user']['input_errors'] = $result;
    $_SESSION['user']['inputs'] = $_POST;
    $_SESSION['user']['inputs']['prev_empl_vals'] = (isset($result['prev_empl_vals']))? $result['prev_empl_vals']: NULL;
    header('location: ../intranet/create_account.php');
}
elseif(is_bool($result) && $result === TRUE){
    echo 'Inserted';

}
