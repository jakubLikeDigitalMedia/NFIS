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

    public function __construct($initData){
        $this->inputs = $initData['inputs'];
        $this->errors = $initData['errors'];

    }

    public function getFieldValue($fieldName,  $default = ''){
        return (isset($this->inputs[$fieldName]))? $this->inputs[$fieldName]: $default;
    }

    public function getFieldError($fieldName){
        return (isset($this->errors[$fieldName]))? $this->errors[$fieldName]: '';
    }

    public function setValueForElement($element, $defalut = ''){
        return $element['value'] = $this->getFieldValue($element['name'], $defalut);
    }

    public function setValuesForElements($elements){
        foreach ($elements as $element) {
            $element['value'] = $this->getFieldValue($element['name']);
        }
        return $element;
    }

    public function setErrorForElement($element, $defalut = ''){
        return $element['options']['error'] = $this->getFieldError($element['name']);
    }

    public function setErrorsForElements($elements){
        foreach ($elements as $element) {
            $element['value'] = $this->getFieldValue($element['name']);
        }
        return $element;
    }

} 