<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 18/12/2013
 * Time: 14:33
 */


// this file contains small helper functions for general use

function get_field_value($field_name,  $input_array, $default = ''){
    return (isset($input_array[$field_name]))? $input_array[$field_name]: $default;
}

function get_field_error($field_name, $error_array){
    return (isset($error_array[$field_name]))? $error_array[$field_name]: '';
}