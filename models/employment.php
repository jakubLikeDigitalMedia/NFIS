<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 19/12/2013
 * Time: 11:56
 */

class Employment extends ModelAbstract{

    public function __construct(){
        parent::init(EMPL_PRM_KEY, EMPL_TABLE);
    }

} 