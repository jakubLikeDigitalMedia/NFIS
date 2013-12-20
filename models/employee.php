<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 13/12/2013
 * Time: 13:00
 */

class Employee extends ModelAbstract{

    protected $activeDirId = NULL;
    protected $name = NULL;
    protected $surname = NULL;
    protected $email = NULL;
    protected $positionId = NULL;
    protected $departmentId = NULL;
    protected $brandId = NULL;
    protected $locationId = NULL;

    //intranet permission
    protected $createForum = NULL;
    protected $uploadDoc = NULL;
    protected $adminPerm = NULL;

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
        $validationResult = $this->validateInputData($employeeDetails);
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

            $employeeValues[E_DOB] = $this->getSQLDOB($employeeValues[E_DOB]);

            $this->dbQueryManager->startTransaction();
            if ($employeeValues[E_PARENT] == 0){
                unset($employeeValues[E_PARENT]);
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

    private function validateInputData($employeeDetails){
        $validation = new InputValidator();
        return $validation->validateEmployee($employeeDetails);
    }

    public function getSQLDOB($userDOB){
        $dob = explode(DOB_SEP, $userDOB);
        return date('Y-m-d', mktime(0,0,0,$dob[1],$dob[0],$dob[2]));
    }







}
