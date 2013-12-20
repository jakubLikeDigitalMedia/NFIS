<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 17/12/2013
 * Time: 11:49
 */

class Location extends ModelAbstract{

    public function __construct(){
        parent::init('location_id', 'location');
    }

} 