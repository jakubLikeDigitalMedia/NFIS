<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 16/12/2013
 * Time: 13:03
 */


include_once '../core_incs.php';

$htmlGen = HtmlGenerator::getInstance();
$htmlGen->startPage();
$htmlGen->navigationMenu();
?>
<h1>Welcome to Nobel Foods Intranet System</h1>
<h2>Please finish you registration before using services</h2>
<?php
$htmlGen->includeTemplate(FORMS.'/employee/employee_create.php');
$htmlGen->closePage();
?>


