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

    protected $dbQueryManager;

    protected $createScriptPath;
    protected $updateScriptPath;
    Protected $deleteScriptPath;

    protected $createFormPath;
    protected $updateFormPath;

    protected function init($primaryKey, $dbTable){
        $this->primaryKey = $primaryKey;
        $this->DbTable = $dbTable;
        $this->dbQueryManager = new DbQueryManager();

        // action script initialization
        $this->actionScriptsPathInit();

        // form paths init
        $this->formPathInit();


    }

    private function actionScriptsPathInit(){
        $modelName = $this->getClassName();
        $this->createScriptPath = SCRIPTS."/$modelName/$modelName".'_'.CREATE_SUF.'.php';
        $this->updateScriptPath = SCRIPTS."/$modelName/$modelName".'_'.UPDATE_SUF.'.php';
        $this->deleteScriptPath = SCRIPTS."/$modelName/$modelName".'_'.DELETE_SUF.'.php';
    }

    protected function getClassName(){
        return strtolower(preg_replace('/(\w)([A-Z])/', '$1_$2', get_class($this)));
    }

    private function formPathInit(){
        $modelName = $this->getClassName();
        $this->createFormPath = FORMS."/$modelName/$modelName".'_'.CREATE_SUF.'.php';
        $this->updateFormPath = FORMS."/$modelName/$modelName".'_'.UPDATE_SUF.'.php';
    }



    public function getPropertyList($propertyName, $orderBy = NULL, $orderType = NULL){
        $query = "SELECT {$this->primaryKey}, $propertyName FROM {$this->DbTable}";
        if (isset($orderBy)) $query .= " ORDER BY $orderBy";
        if (isset($orderType)) $query .= " $orderType";
        return $this->dbQueryManager->selectQuery($query, $this->primaryKey, 'list');

    }

    public function createRecord($insertValues, $options = NULL){
        $dbQueryManager = new DbQueryManager();
        return $dbQueryManager->insert($insertValues, $this->DbTable, $options);

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



} 