<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 11:49
 */

class Brand extends ModelAbstract{

    public function __construct(){
        parent::init(B_PRM_KEY, B_TABLE);
    }

} 