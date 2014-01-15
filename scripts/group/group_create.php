<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 14/01/2014
 * Time: 18:41
 */

require('../../core_incs.php');
$_post_group = $_POST['new_group'];
//creating a new group
$group_name = $_post_group;
$group_table = "`group`";
$group_model = new Group();
$group_id = $group_model->createRecord(array("title" => "$group_name"), $group_table);

//adding permissions for the group
$permissions_table = "`".PE_TABLE."`";
$permissions_model = new Permissions();
$group_array = $permissions_model->createGroupArray($group_id, $_POST);// creating a multiple insert

$permissions_model->createRecord($group_array, $permissions_table, array('multiple_insert' => TRUE));

header("Location: " . $_SERVER['HTTP_REFERER'] . "?group_added=true&group_name=$group_name");