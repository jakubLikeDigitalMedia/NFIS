<?php

class Poll extends ModelAbstract{

    public function __construct(){
        parent::init(PO_PRM_KEY, PO_TABLE);
    }
} 