<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 11:49
 */

class Department extends ModelAbstract{

    public function __construct(){
        parent::init('dprmt_id', 'department');
    }

} 