<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 16/12/2013
 * Time: 14:00
 */

class DbQueryManager {

    private $conn;


    public function __construct(){
        $this->conn = DBManager::getConnection();
    }

    public function selectQuery($query, $primaryKey, $returnType = 'array'){
        $res = $this->conn->query($query);
        if ($res){

            if ($res->num_rows === 0) return NULL;

            $result = array();
            switch ($returnType){
                case 'array':
                    while($rec = $res->fetch_assoc()){
                        $id = $rec[$primaryKey];
                        unset($rec[$primaryKey]);
                        $result[$id] = $rec;
                    }
                    break;
                case 'object':
                    while($rec = $res->fetch_object()){
                        $result[$rec->{$primaryKey}] = $rec;
                    }
                    break;
                case 'list': // returns list as id => value array
                    while($rec = $res->fetch_assoc()){
                        $result[array_shift($rec)] = array_shift($rec);
                    }
            }
            return $result;
        }
        else{
            throw new DatabaseErrorException($this->conn->error);
        }

    }
    /*
     * function iserts data into database
     *
     * @insertValues: array of values column => value
     */
    public function insert($insertValues, $table, $options = NULL){
        //die(var_dump($options));
        $columns = array();
        $values = array();
        foreach($insertValues as $column => $value){
            $columns[] = $column;
            $values[] = $this->conn->real_escape_string($value);
        }
        $query = "INSERT INTO $table (".implode(',', $columns).") VALUES ('".implode("','", $values)."')";

        if (isset($options['check_parent']) && $options['check_parent'] === FALSE){
            $query = 'SET FOREIGN_KEY_CHECKS = 0; '.$query;
            if ($this->multiQuery($query))  return $this->conn->insert_id; // last inserted id
        }

        //die($query);
        if ($this->conn->query($query)){
            return $this->conn->insert_id; // last inserted id
        }
        else{
            $this->rollBack();
            throw new DatabaseErrorException($this->conn->error, $query);
        }

    }


    private function multiQuery($multiQuery){
        if ($this->conn->multi_query($multiQuery)){
            do {
                if (!$this->conn->next_result()) throw new DatabaseErrorException($this->conn->error, $multiQuery);
            } while ($this->conn->more_results());
            if ($error = $this->conn->error){
                $this->rollBack();
                throw new DatabaseErrorException($error, $multiQuery);
            }
            else return TRUE;
        }
    }


    public function startTransaction(){
        $this->conn->autocommit(FALSE);
    }

    private function rollBack(){
        $this->conn->rollback();

    }

    public function commit(){
        $this->conn->commit();
    }




} 