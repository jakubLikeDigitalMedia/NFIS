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

    protected $createScript;
    protected $updateScript;
    Protected $deleteScript;

    protected function init($primaryKey, $dbTable){
        $this->primaryKey = $primaryKey;
        $this->DbTable = $dbTable;
        $this->dbQueryManager = new DbQueryManager();

        // action script initialization
        $this->actionScriptsInit();


    }

    protected function actionScriptsInit(){
        $modelName = strtolower(preg_replace('/(\w)([A-Z])/', '$1_$2', get_class($this)));
        $this->createScript = SCRIPTS."/$modelName/$modelName".'_'.CREATE_SUF.'.php';
        $this->updateScript = SCRIPTS."/$modelName/$modelName".'_'.UPDATE_SUF.'.php';
        $this->deleteScript = SCRIPTS."/$modelName/$modelName".'_'.DELETE_SUF.'.php';
    }

    public function getPropertyList($propertyName, $orderBy = NULL, $orderType = NULL){
        $query = "SELECT {$this->primaryKey}, $propertyName FROM {$this->DbTable}";
        if (isset($orderBy)) $query .= " ORDER BY $orderBy";
        if (isset($orderType)) $query .= " $orderType";
        return $this->dbQueryManager->selectQuery($query, $this->primaryKey, 'list');

    }

    public function createRecord($insertValues, $table, $options = NULL){
        $dbQueryManager = new DbQueryManager();
        return $dbQueryManager->insert($insertValues, $table, $options);

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



} 