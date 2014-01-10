<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 10/01/2014
 * Time: 13:47
 */

class FormHelper {

    private $inputs;
    private $errors;

    public function __construct($inputs, $errors){
        $this->inputs = $inputs;
        $this->errors = $errors;

    }

    public function getFieldValue($fieldName,  $default = ''){
        return (isset($this->inputs[$fieldName]))? $this->inputs[$fieldName]: $default;
    }

    public function getFieldError($fieldName){
        return (isset($this->errors[$fieldName]))? $this->errors[$fieldName]: '';
    }

} 