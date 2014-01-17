<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 11:42
 */

abstract class ModelAbstract {

    // DB table info
    protected $primaryKey;
    protected $DbTable;
    protected static $_DbTable;

    protected $modelName;

    protected $dbQueryManager;
    
    protected $actionScript = SCRIPTS;

    protected $createScriptPath;
    protected $updateScriptPath;
    Protected $deleteScriptPath;

    protected $createFormPath;
    protected $updateFormPath;

    protected function init($primaryKey, $dbTable){
        $this->primaryKey = $primaryKey;
        $this->DbTable = self::$_DbTable = $dbTable;
        $this->dbQueryManager = new DbQueryManager();
        $this->modelName = $this->getClassName();

        // action script initialization
        $this->actionScriptsPathInit();

        // form paths init
        $this->formPathInit();


    }

    private function actionScriptsPathInit(){
        $this->createScriptPath = SCRIPTS."/{$this->modelName}/{$this->modelName}".'_'.CREATE_SUF.'.php';
        $this->updateScriptPath = SCRIPTS."/{$this->modelName}/{$this->modelName}".'_'.UPDATE_SUF.'.php';
        $this->deleteScriptPath = SCRIPTS."/{$this->modelName}/{$this->modelName}".'_'.DELETE_SUF.'.php';
    }

    private function formPathInit(){
        $modelName = $this->getClassName();
        $this->createFormPath = FORMS."/$modelName/$modelName".'_'.CREATE_SUF.'.php';
        $this->updateFormPath = FORMS."/$modelName/$modelName".'_'.UPDATE_SUF.'.php';
    }

    protected function getClassName(){
        return strtolower(preg_replace('/(\w)([A-Z])/', '$1_$2', get_class($this)));
    }

    public function getSqlQueryField($fieldName){
        return '`'. $this->DbTable . '`.`'. $fieldName .'`';
    }

    public function getPropertyList($propertyName, $orderType = 'DESC'){
        $query = "SELECT {$this->primaryKey}, $propertyName FROM {$this->DbTable} ORDER BY $propertyName $orderType";
        return $this->dbQueryManager->selectQuery($query, $this->primaryKey, 'list');

    }

    public function createRecord($insertValues, $options = NULL){
        $dbQueryManager = new DbQueryManager();
        return $dbQueryManager->insert($insertValues, "`$this->DbTable`", $options);

    }

    public function getRecords($mysqlQuery, $type = 'array'){
        return $this->dbQueryManager->selectQuery($mysqlQuery, $this->primaryKey, $type);

    }

    public function getProperty($propertyName){
        if (property_exists($this, $propertyName)) return $this->{$propertyName};
        else return NULL;
    }

    public function getProperties($propertyNames){
        if (!is_array($propertyNames)) return NULL;
        else{
            $propertyValues = array();
            foreach ($propertyNames as $propertyName) {
                $propertyValues[$propertyName] = $this->getProperty($this, $propertyName);
            }

        }
    }

    public function getCheckboxValue($_post, $field_name){
        if(isset($_post[$field_name]) && ($_post[$field_name] === "1")){
            return $_post[$field_name];
        }else{
            return 0;
        }
    }

    public function recordExist($property){
        $query =  "SELECT `{$this->primaryKey}`, $property FROM `{$this->DbTable}`";
        $result = $this->dbQueryManager->selectQuery($query, $this->primaryKey, 'list');
        return (boolean)sizeof($result) > 0;
    }

    /*
     * ========================================================================================
     * Session handling when working with forms
     */

    public function saveInputsToSession($inputs){
        $_SESSION[$this->modelName]['inputs'] = $inputs;
    }

    public function getInputsFromSession(){
        (isset($_SESSION[$this->modelName]['inputs']))? $_SESSION[$this->modelName]['inputs']: array();
    }

    public function saveInputsErrorsToSession($errors){
        $_SESSION[$this->modelName]['errors'] = $errors;
    }

    public function getInputsErrorsFromSession(){
        (isset($_SESSION[$this->modelName]['errors']))? $_SESSION[$this->modelName]['errors']: array();
    }

    //==========================================================================================

    public function updateMultipleValues($values, $column){
        $dbc = new DbQueryManager();
        foreach($values as $value){
            $column_values[$column . '-' . $value] = $value;
        }
        $dbc->update($column_values, '', "`$this->DbTable`", array('multiple_update_one' => TRUE));
    }



} 