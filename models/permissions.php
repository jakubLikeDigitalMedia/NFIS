<?php

class Permissions extends ModelAbstract{

    public function __construct(){
        parent::init(PE_PRM_KEY, PE_TABLE);
    }
} 