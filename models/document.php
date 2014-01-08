<?php

class Document extends ModelAbstract{

    public function __construct(){
        parent::init(D_PRM_KEY, D_TABLE);
    }
} 