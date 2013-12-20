<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 19/12/2013
 * Time: 10:47
 */

class Address extends ModelAbstract{

    public function __construct(){
        parent::init(OA_PRM_KEY, OA_TABLE);
    }
} 