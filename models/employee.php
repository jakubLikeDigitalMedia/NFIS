<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 13/12/2013
 * Time: 13:00
 */

class Employee extends ModelAbstract{

    protected  $activeDirId = NULL;
    private $name = NULL;
    private $surname = NULL;
    private $email = NULL;
    private $possitionId = NULL;
    private $departmentId = NULL;
    private $brandId = NULL;

    //intranet permission
    private $createForum = NULL;
    private $uploadDoc = NULL;
    private $admin = NULL;

    public function __construct(){
        parent::init(E_PRM_KEY, E_TABLE);
    }

    /*
     * Getter Methods
     * --------------
     */

    public function getEmployees($from, $to){
        // return list of employees objects from db
    }

    public static function getParentId($name){
        /*
        $dbQueryManager = new DbQueryManager();
        $query =  'SELECT '.E_SUPERIOR.' FROM '.E_TABLE. 'WHERE '.E_NAME." LIKE %$name%";
        return $dbQueryManager->selectQuery($query,E_PRM_KEY);
        */
        return NULL;
    }

    public function getSuperiors(){
        return NULL;
    }

    /*
     * -----------------------------------------------
     */


    /*
     * Loads employee info from DB
     * used in __construct
     */
    public function loadEmployee($AD_id){
        $query = "SELECT `AD_id` FROM `{$this->DbTable}` WHERE `AD_id` = $AD_id";
        $employee = $this->dbQueryManager->selectQuery($query, $this->primaryKey);
        if (empty($employee)) return NULL;
        elseif (count($employee) > 1){
            throw new DuplicitDBValuesException($this->DBtable, 'AD_id');
        }
        else{
            $this->activeDirId = $AD_id;
        }


    }

    public function createForum(){
        return (bool) $this->createForum;
    }

    /*
     * Create Employee account
     *
     * @return: bool
     * @$employeeDetails - array of inserted values in format 'column' => 'value'
     */
    public function createAccount($employeeDetails){
        $validationResult = self::validateInputData($employeeDetails);
        if (empty($validationResult)){
            $employmentValues = $officeAddressValues = $employeeValues = array();
            foreach ($employeeDetails as $key => $value) {
                $key = explode(SEP, $key);
                $table = $key[0];
                $column = $key[1];
                switch($table){
                    case E_TABLE:
                        $employeeValues[$column] = $value;
                        $employeeValues[E_ADID] = $_SESSION['user']['userADId'];
                        break;
                    case OA_TABLE: $officeAddressValues[$column] = $value;
                        break;
                    case EMPL_TABLE:
                        $employmentValues[$column] = $value;
                        $employmentValues[EMPL_CURRENT] = 1;
                        break;
                }
            }

            $employment = new Employment();
            $officeAddress = new Address();

            $this->dbQueryManager->startTransaction();
            if ($employeeValues[E_PARENT] == 0){
                $employmentValues[EMPL_EMPLOYEE] = $this->createRecord($employeeValues, E_TABLE, array('check_parent' => FALSE));
            }
            $employmentValues[EMPL_OFFICE_ADDRESS] = $officeAddress->createRecord($officeAddressValues, OA_TABLE);
            $employment->createRecord($employmentValues, EMPL_TABLE);
            $this->dbQueryManager->commit();
            return true;
        }
        else{
            return $validationResult;
        }



    }

    private static function validateInputData($employeeDetails){
        $validation = new InputValidator();
        return $validation->validateEmployee($employeeDetails);
    }





}
