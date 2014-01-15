<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 17:44
 */

class InputValidator extends GUMP{

    private $predefRules = array(
        'name' => 'required|alpha_with_space|max_len,128',
        'email' => 'required|valid_email',
        'DOB' => 'required|DOB',
        'intNoZeroReq' => 'required|int_no_zero',
        'street' => 'required|alpha_numeric_with_space|max_len,255',
        'postcode' => 'required|alpha_numeric_with_space|max_len,128',
        'alphaNumLen255' => 'alpha_with_space|max_len,255'
    );

    private $errorMessages = array(
        'validate_alpha' => 'Only letters are allowed',
        'validate_alpha_with_space' => 'Only letters are allowed',
        'validate_DOB' => 'Invalid date format',
        'validate_street_address' => 'Only alphanumeric characters with spaces are allowed',
        'validate_alpha_numeric' => 'Only alphanumeric characters are allowed',
        'validate_alpha_numeric_with_space' => 'Only alphanumeric characters with spaces are allowed',
        'validate_phone_num' => 'Enter your phone number in following format +477 123 456 789',
        'validate_valid_email' => 'Invalid email format',
        'validate_required' => 'This field is required',
        'validate_integer' => 'Value must be integer',
        'validate_max_len' => 'Value or string must be max ? characters long',
        'validate_int_no_zero' => 'Select value'
    );

    /*
     * Custom validator extensions
     */
    public function validate_phone_num(){

    }

    public function validate_date_of_birth(){

    }

    public function validate_alpha_with_space($field, $input, $param = NULL){

        if(!isset($input[$field])|| empty($input[$field]))
        {
            return;
        }

        $passes = preg_match('/[a-zA-Z\s]+/', $input[$field]);

        if(!$passes) {
            return array(
                'field' => $field,
                'value' => $input[$field],
                'rule'	=> __FUNCTION__,
                'param' => $param
            );
        }

    }

    public function validate_alpha_numeric_with_space($field, $input, $param = NULL){

        if(!isset($input[$field])|| empty($input[$field]))
        {
            return;
        }

        $passes = preg_match('/[a-zA-Z\s\d]+/', $input[$field]);

        if(!$passes) return $this->getResultArray($field, $input[$field], __FUNCTION__, $param);

    }

    public function validate_int_no_zero($field, $input, $param = NULL){

        if(!isset($input[$field])|| empty($input[$field]))
        {
            return;
        }

        $passes = ($input[$field] !== 0 );

        if(!$passes) return $this->getResultArray($field, $input[$field], __FUNCTION__, $param);

    }

    public function validate_DOB($field, $input, $param = NULL){

        if(!isset($input[$field]) || empty($input[$field]))
        {
            return;
        }

        $passes = preg_match('/\d{1,2}\.\d{1,2}\.\d{4}/', $input[$field]);

        if(!$passes) return $this->getResultArray($field, $input[$field], __FUNCTION__, $param);

    }

    private function getResultArray($field, $value, $func, $param){
        return array(
            'field' => $field,
            'value' => $value,
            'rule'	=> $func,
            'param' => $param
        );

    }

    public function validateEmployee($employeeDetails){
        $filterRules = array(
            'name' => 'trim|sanitize_string|mysql_escape',
            'surname' => 'trim|sanitize_string|mysql_escape',
            'date_of_birth' => 'trim',
            'email' => 'trim|sanitize_email|mysql_escape',
            'id_type' => 'trim|sanitize_numbers|mysql_escape',
            'id_brand' => 'trim|sanitize_numbers|mysql_escape',
            'id_location' => 'trim|sanitize_numbers|mysql_escape',
            'id_dprmt' => 'trim|sanitize_numbers|mysql_escape',
            'city' => 'trim|sanitize_string|mysql_escape',
            'county' => 'trim|sanitize_string|mysql_escape'
        );

        $validationRules = array(
            E_TABLE.SEP.E_NAME => $this->predefRules['name'],
            E_TABLE.SEP.E_SURNAME => $this->predefRules['name'],
            E_TABLE.SEP.E_DOB => $this->predefRules['DOB'],
            E_TABLE.SEP.E_EMAIL => $this->predefRules['email'],
            E_TABLE.SEP.E_PHONE_NUMBER => 'required',
            EMPL_TABLE.SEP.EMPL_POSITION => $this->predefRules['intNoZeroReq'],
            EMPL_TABLE.SEP.EMPL_BRAND => $this->predefRules['intNoZeroReq'],
            EMPL_TABLE.SEP.EMPL_LOCATION => $this->predefRules['intNoZeroReq'],
            EMPL_TABLE.SEP.EMPL_DEPARTMENT => $this->predefRules['intNoZeroReq'],
            E_TABLE.SEP.E_PARENT => 'integer',
            OA_TABLE.SEP.OA_STREET => $this->predefRules['street'],
            OA_TABLE.SEP.OA_POSTCODE => $this->predefRules['postcode'],
            OA_TABLE.SEP.OA_CITY => 'required|'.$this->predefRules['alphaNumLen255'],
            OA_TABLE.SEP.OA_COUNTY => $this->predefRules['alphaNumLen255'],
        );

        $this->sanitize($employeeDetails, $filterRules);
        return $this->getErrors($employeeDetails, $validationRules);

    }

    public function validateEmployeePrevEmpl($employeeDetails){

        $validationRules = array(
            PREV_PREFIX.EMPL_TABLE.SEP.EMPL_POSITION => $this->predefRules['intNoZeroReq'],
            PREV_PREFIX.EMPL_TABLE.SEP.EMPL_BRAND => $this->predefRules['intNoZeroReq'],
            PREV_PREFIX.EMPL_TABLE.SEP.EMPL_LOCATION => $this->predefRules['intNoZeroReq'],
            PREV_PREFIX.EMPL_TABLE.SEP.EMPL_DEPARTMENT => $this->predefRules['intNoZeroReq'],
            PREV_PREFIX.OA_TABLE.SEP.OA_STREET => $this->predefRules['street'],
            PREV_PREFIX.OA_TABLE.SEP.OA_POSTCODE => $this->predefRules['postcode'],
            PREV_PREFIX.OA_TABLE.SEP.OA_CITY => 'required|'.$this->predefRules['alphaNumLen255'],
            PREV_PREFIX.OA_TABLE.SEP.OA_COUNTY => $this->predefRules['alphaNumLen255'],
        );

        return $this->getErrors($employeeDetails, $validationRules);

    }

    private function getErrors($employeeDetails, $validationRules){
        $validationResult = $this->validate($employeeDetails, $validationRules);
        //die(var_dump($validationResult));
        if (!is_array($validationResult)) return NULL;
        else{
            $errorMessages = array();
            foreach ($validationResult as $resultField) {
                $errorMessages[$resultField['field']] = (!empty($resultField['param']))? str_replace('?', $resultField['param'], $this->errorMessages[$resultField['rule']]): $errorMessages[$resultField['field']] = $this->errorMessages[$resultField['rule']];
                $errorMessages[$resultField['field']] = "<b>{$errorMessages[$resultField['field']]}</b>";
            }
            return $errorMessages;
        }
    }



} 