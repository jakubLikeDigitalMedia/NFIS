<?php

class Forum extends ModelAbstract{

    public function __construct(){
        parent::init(F_PRM_KEY, F_TABLE);
    }
} 