<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 08/01/2014
 * Time: 11:53
 */

include('../../core_incs.php');

$group = new Group();
$createGroupForm = $group->createFormArray();
$group->createForm($createGroupForm);